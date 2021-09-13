<?php


namespace aps\model;

use aps\appcore\JsonMsg;
use aps\model\repository\crud;

if ( !isset($_SESSION) ) { session_start (); }

class RoleModel extends crud
{
    private int $id;
    private string $cargo;
    private crud $crud;
    private array $dados;

    use JsonMsg;

    public function __construct ()
    {
        $this->crud = new crud();
    }

    public function newRole(): void
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);

        $dataSave = [
            'id' => ( $data['id'] ?? null ),
            'cargo' => ( $data['cargo'] ?? null )
        ];

        $result = $this->crud->insert ('role', $dataSave);
        if ($result === true) {
            $this->message (['aviso' => 'Registro salvo com sucesso']);
            exit;
        } else {
            echo $result;
        }

    }

    public function listAll()
    {
        $this->dados = $this->crud->read ('role', null, null, null);
        $r = [];
        foreach ($this->dados as $juries){
            $jury = [
                'id' => $juries['id'],
                'cargo' => $juries['cargo']
            ];
            array_push ($r, $jury);
        }
        $this->message ($r);
    }

    public function listById(int $id)
    {
        $jury = $this->crud->read('role', 'WHERE id=:id', 'id='. $id, null);
        return $jury[0];
    }

    public function editById(int $id, array $data = null)
    {
        if (is_null ($data)){
            return $this->listById ($id);
        }
    }

    public function updateRole(): void
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);

        if (empty($data)) {
            $this->message (['erro' => 'A requisição deve conter os dados do cargo']);
            exit;
        }

        if (!isset($data['id']) || $data['id'] == ''){
            $this->message (['erro' => 'O id do cargo deve ser informado']);
            exit;
        }
        $dataSave = [
            'cargo' => ( $data['cargo'] ?? null )
        ];

        $result = $this->crud->update ('role', $dataSave, ['id' => $data['id']]);
        if ($result === true) {
            $this->message (['aviso' => 'Registro salvo com sucesso']);
        } else {
            echo $result;
        }

    }

    public function deleteRole(): void
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);

        if (empty($data)) {
            $this->message (['erro' => 'A requisição deve conter os dados do cargo']);
            exit;
        }

        if (!isset($data['id']) || $data['id'] == ''){
            $this->message (['erro' => 'O id do cargo deve ser informado']);
            exit;
        }

        $result = $this->crud->delete ('role', ['id' => $data['id']]);

        if ($result) {
            $this->message (['aviso' => 'Cargo apagado']);
        } else {
            $this->message (['aviso' => $result]);
        }

    }
}