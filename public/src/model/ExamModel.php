<?php


namespace aps\model;


use aps\appcore\JsonMsg;
use aps\model\repository\crud;

if ( !isset($_SESSION) ) { session_start (); }

class ExamModel extends crud
{
    private int $id;
    private string $simulado;
    private crud $crud;
    private array $dados;

    use JsonMsg;

    public function __construct ()
    {
        $this->crud = new crud();
    }

    public function newExam(): void
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);

        $dataSave = [
            'id' => ( $data['id'] ?? null ),
            'ano' => ( $data['ano'] ?? null ),
            'id_role' => ( $data['id_role'] ?? null ),
            'id_jury' => ( $data['id_jury'] ?? null ),
            'id_discipline' => ( $data['id_discipline'] ?? null ),
            'id_subject' => ( $data['id_subject'] ?? null ),
            'simulado' => ( $data['simulado'] ?? null )
        ];

        $result = $this->crud->insert ('exam', $dataSave);
        if ($result === true) {
            $this->message (['aviso' => 'Registro salvo com sucesso']);
            exit;
        } else {
            echo $result;
        }

    }

    public function listAll()
    {
        $this->dados = $this->crud->read (
            'exam',
            'join role on role.id = exam.id_role join jury on jury.id = exam.id_jury join discipline on discipline.id = exam.id_discipline join subject on subject.id = exam.id_subject',
            null,
            array(
                'exam.id',
                'exam.ano',
                'exam.id_role',
                'role.cargo',
                'exam.id_jury',
                'jury.banca',
                'exam.id_discipline',
                'discipline.disciplina',
                'exam.id_subject',
                'subject.assunto',
                'exam.simulado'
            ));
        $r = [];
        foreach ($this->dados as $exams){
            $exam = [
                'id' => $exams['id'],
                'ano' => $exams['ano'],
                'cargo' => ['id' => $exams['id_role'], 'descricao' => $exams['cargo']],
                'banca' => ['id' => $exams['id_jury'], 'descricao' => $exams['banca']],
                'disciplina' => ['id' => $exams['id_discipline'], 'descricao' => $exams['disciplina']],
                'assunto' => ['id' => $exams['id_subject'], 'descricao' => $exams['assunto']],
                'simulado' => $exams['simulado']
            ];
            array_push ($r, $exam);
        }
        $this->message ($r);
    }

    public function listById(int $id)
    {
        $exam = $this->crud->read('exam',
            'WHERE id=:id',
            'id='. $id,
            null);
        return $exam[0];
    }

    public function editById(int $id, array $data = null)
    {
        if (is_null ($data)){
            return $this->listById ($id);
        }
    }

    public function updateExam(): void
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);


        if (empty($data)) {
            $this->message (['aviso' => 'ERRO: A requisição deve conter os dados do simulado']);
            exit;
        }

        if (!isset($data['id']) || $data['id'] == ''){
            $this->message (['aviso' => 'ERRO: O id do simulado deve ser informado']);
            exit;
        }

        $bd = $this->listById ($data['id']);

        $dataSave = [
            'ano' => ( $data['ano'] ?? $bd['ano'] ),
            'id_role' => ( $data['id_role'] ?? $bd['id_role'] ),
            'id_jury' => ( $data['id_jury'] ?? $bd['id_jury'] ),
            'id_discipline' => ( $data['id_discipline'] ?? $bd['id_discipline'] ),
            'id_subject' => ( $data['id_subject'] ?? $bd['id_subject'] ),
            'simulado' => ( $data['simulado'] ?? $bd['simulado'] )
        ];

        $result = $this->crud->update ('exam', $dataSave, ['id' => $data['id']]);
        if ($result === true) {
            $this->message (['aviso' => 'Registro salvo com sucesso']);
        } else {
            $this->message ($result);
        }

    }

    public function deleteExam(): void
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);

        if (empty($data)) {
            $this->message (['erro' => 'A requisição deve conter os dados do simulado']);
            exit;
        }

        if (!isset($data['id']) || $data['id'] == ''){
            $this->message (['erro' => 'O id do simulado deve ser informado']);
            exit;
        }

        $result = $this->crud->delete ('exam', ['id' => $data['id']]);

        if ($result) {
            $this->message (['aviso' => 'Simulado apagado']);
        } else {
            $this->message (['aviso' => $result]);
        }

    }

}