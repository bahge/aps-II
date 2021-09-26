<?php


namespace aps\model;


use aps\appcore\JsonMsg;
use aps\model\repository\crud;

class QuestionModel extends crud
{
    private crud $crud;
    private int $numquestoes;
    use JsonMsg;

    public function __construct ()
    {
        $this->crud = new crud();
        $this->numquestoes = getenv ('NUMQUESTOESPORPAGINA');
    }

    public function newQuestion() : void
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);

        $dataSave = [
            'id' => ( $data['id'] ?? null ),
            'tipo' => ( $data['tipo'] ?? null ),
            'pergunta' => ( $data['pergunta'] ?? null ),
            'resposta1' => ( $data['resposta1'] ?? null ),
            'resposta2' => ( $data['resposta2'] ?? null ),
            'resposta3' => ( $data['resposta3'] ?? null ),
            'resposta4' => ( $data['resposta4'] ?? null ),
            'resposta5' => ( $data['resposta5'] ?? null ),
            'explicacao' => ( $data['explicacao'] ?? null ),
            'correta' => ( $data['correta'] ?? null),
            'id_exam' => ( $data['id_exam'] ?? null),
            'id_role' => ( $data['id_role'] ?? null),
            'id_jury' => ( $data['id_jury'] ?? null),
            'id_discipline' => ( $data['id_discipline'] ?? null)
        ];
        $result = $this->crud->insert ('question', $dataSave);
        if ($result === true) {
            $this->message (['aviso' => 'Registro salvo com sucesso']);
        } else {
            echo $result;
        }
    }

    public function listarPerguntas (int $pg = null) : void
    {
        $args = null;
        $filters = [];
        if (isset($_GET['id_subject'])) {
            $var = 'id_subject = ' . filter_input (
                        INPUT_GET,
                        'id_subject',
                        FILTER_SANITIZE_NUMBER_INT
            );
            array_push($filters, $var);
        }

        if (isset($_GET['id_jury'])) {
            $var = 'id_jury = ' . filter_input (
                    INPUT_GET,
                    'id_jury',
                    FILTER_SANITIZE_NUMBER_INT
                );
            array_push($filters, $var);
        }

        if (isset($_GET['id_role'])) {
            $var = 'id_role = ' . filter_input (
                    INPUT_GET,
                    'id_role',
                    FILTER_SANITIZE_NUMBER_INT
                );
            array_push($filters, $var);
        }

        if (isset($_GET['id_discipline'])) {
            $var = 'id_discipline = ' . filter_input (
                    INPUT_GET,
                    'id_discipline',
                    FILTER_SANITIZE_NUMBER_INT
                );
            array_push($filters, $var);
        }

        if (isset($_GET['pergunta'])) {
            $var = 'pergunta like "%' . filter_input (
                    INPUT_GET,
                    'pergunta',
                    FILTER_SANITIZE_STRING
                ) . '%"';
            array_push($filters, $var);
        }

        if (!empty($filters)) {
            $args = 'WHERE ' . implode(' AND ', $filters );
        }

        $num = $this->numquestoes;
        $count = $this->numMaxQuestoes ($args);
        $numPag = ( $count % $num ) > 0 ? (int) ($count / $num) + 1 : ($count / $num) ;
        if(!is_null($pg)){
            $page = $pg - 1;
            $offset = ($page * $num);
            if ($offset > $count) {
                $this->message (['aviso' => 'O intervalo de questões não existe']);
                exit;
            }
            $paginacao = ['pg_atual' => $pg, 'pages' => $numPag];
            $args = (is_null($args) ? '' : $args);
            $args .= " LIMIT {$num} OFFSET {$offset}";
        } else {
            $args = null;
            $paginacao = null;
        }
        $results = $this->crud->read (
            'question',
            $args,
            null,
            array(
                'id',
                'tipo',
                'pergunta',
                'resposta1',
                'resposta2',
                'resposta3',
                'resposta4',
                'resposta5'
            )
        );
        $questions = [];
        foreach ($results as $question){
            if ($question['tipo'] == '1' ) {
                $respostas = [
                    'resposta1' => $question['resposta1'],
                    'resposta2' => $question['resposta2'],
                    'resposta3' => $question['resposta3'],
                    'resposta4' => $question['resposta4'],
                    'resposta5' => $question['resposta5'],
                ];
                shuffle($respostas);
            } else {
                $respostas = null;
            }
            $array = [
                'id' => $question['id'],
                'tipo' => $question['tipo'],
                'pergunta' => $question['pergunta'],
                'respostas' => $respostas
            ];
            array_push ($questions, $array);
        }
        if(!is_null($paginacao)){
            $questions_return = [
                'questions' => $questions,
                'pagination' => $paginacao ];
        } else {
            $questions_return = [
                'questions' => $questions ];
        }
        if (empty($questions)) {
            $this->message(['aviso' => 'Nenhum pergunta retornada']);
        } else {
            $this->message ($questions_return);
        }

    }

    private function numMaxQuestoes ($args) : int
    {
        $result = $this->crud->read ('question', $args, null, array('count(id)'));
        return (int) $result[0]['count(id)'];
    }

    public function responder () : void
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);

        $r = $this->listById ($data['id']);
        if ($r['correta'] == $data['resposta']) {
            $this->message (['aviso' => 'Acertou', 'explicacao' => $r['explicacao']]);
            exit;
        } else {
            $this->message (['aviso' => 'Errou']);
            exit;
        }
    }

    public function listById(int $id)
    {
        $question = $this->crud->read('question', 'WHERE id=:id', 'id='. $id, array('correta', 'explicacao'));
        return $question[0];
    }
}