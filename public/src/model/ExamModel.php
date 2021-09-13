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
        $this->dados = $this->crud->read ('exam', null, null, null);
        $r = [];
        foreach ($this->dados as $exams){
            $exam = [
                'id' => $exams['id'],
                'simulado' => $exams['simulado']
            ];
            array_push ($r, $exam);
        }
        $this->message ($r);
    }

    public function listById(int $id)
    {
        $exam = $this->crud->read('exam', 'WHERE id=:id', 'id='. $id, null);
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
            $this->message (['erro' => 'A requisição deve conter os dados do simulado']);
            exit;
        }

        if (!isset($data['id']) || $data['id'] == ''){
            $this->message (['erro' => 'O id do simulado deve ser informado']);
            exit;
        }
        $dataSave = [
            'simulado' => ( $data['simulado'] ?? null )
        ];

        $result = $this->crud->update ('exam', $dataSave, ['id' => $data['id']]);
        if ($result === true) {
            $this->message (['aviso' => 'Registro salvo com sucesso']);
        } else {
            echo $result;
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