<?php


namespace aps\model;

use aps\appcore\JsonMsg;
use aps\model\repository\crud;

if ( !isset($_SESSION) ) { session_start (); }

class DisciplineModel extends crud
{
    private int $id;
    private string $disciplina;
    private crud $crud;
    private array $dados;
    use JsonMsg;

    public function __construct ()
    {
        $this->crud = new crud();
    }

    public function newDiscipline(): void
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);

        $dataSave = [
            'id' => ( $data['id'] ?? null ),
            'disciplina' => ( $data['disciplina'] ?? null )
        ];

        $result = $this->crud->insert ('discipline', $dataSave);
        if ($result === true) {
            $this->message (['aviso' => 'Registro salvo com sucesso']);
            exit;
        } else {
            echo $result;
        }

    }

    public function listAll(int $txt = null)
    {
        $this->dados = $this->crud->read ('discipline', null, null, null);
        $r = [];
        foreach ($this->dados as $juries){
            $jury = [
                'id' => $juries['id'],
                'disciplina' => $juries['disciplina']
            ];
            array_push ($r, $jury);
        }
        if (is_null ($txt)){
            $this->message ($r);
        } else {
            return $r;
        }
    }

    public function listById(int $id)
    {
        $jury = $this->crud->read('discipline', 'WHERE id=:id', 'id='. $id, null);
        return $jury[0];
    }

    public function editById(int $id, array $data = null)
    {
        if (is_null ($data)){
            return $this->listById ($id);
        }
    }

    public function updateDiscipline(): void
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);

        if (empty($data)) {
            $this->message (['erro' => 'A requisição deve conter os dados da disciplina']);
            exit;
        }

        if (!isset($data['id']) || $data['id'] == ''){
            $this->message (['erro' => 'O id da disciplina deve ser informado']);
            exit;
        }
        $dataSave = [
            'disciplina' => ( $data['disciplina'] ?? null )
        ];

        $result = $this->crud->update ('discipline', $dataSave, ['id' => $data['id']]);
        if ($result === true) {
            $this->message (['aviso' => 'Registro salvo com sucesso']);
        } else {
            echo $result;
        }

    }

    public function deleteDiscipline(): void
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);

        if (empty($data)) {
            $this->message (['erro' => 'A requisição deve conter os dados da disciplina']);
            exit;
        }

        if (!isset($data['id']) || $data['id'] == ''){
            $this->message (['erro' => 'O id da disciplina deve ser informado']);
            exit;
        }

        $result = $this->crud->delete ('discipline', ['id' => $data['id']]);

        if ($result) {
            $this->message (['aviso' => 'Disciplina apagada']);
        } else {
            $this->message (['aviso' => $result]);
        }

    }


}