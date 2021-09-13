<?php


namespace aps\model;


use aps\appcore\JsonMsg;
use aps\model\repository\crud;

if ( !isset($_SESSION) ) { session_start (); }

class JuryModel extends crud
{
    private int $id;
    private string $banca;
    private crud $crud;
    private array $dados;
    use JsonMsg;

    public function __construct ()
    {
        $this->crud = new crud();
    }

    public function newJury(): void
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);

        $dataSave = [
            'id' => ( $data['id'] ?? null ),
            'banca' => ( $data['banca'] ?? null )
        ];

        $result = $this->crud->insert ('jury', $dataSave);
        if ($result === true) {
            $this->message (['aviso' => 'Registro salvo com sucesso']);
            exit;
        } else {
            echo $result;
        }

    }

    public function listAll()
    {
        $this->dados = $this->crud->read ('jury', null, null, null);
        $r = [];
        foreach ($this->dados as $juries){
            $jury = [
                'id' => $juries['id'],
                'banca' => $juries['banca']
            ];
            array_push ($r, $jury);
        }
        $this->message ($r);
    }

    public function listById(int $id)
    {
        $jury = $this->crud->read('jury', 'WHERE id=:id', 'id='. $id, null);
        return $jury[0];
    }

    public function editById(int $id, array $data = null)
    {
        if (is_null ($data)){
            return $this->listById ($id);
        }
    }

    public function updateJury(): void
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);

        if (empty($data)) {
            $this->message (['erro' => 'A requisição deve conter os dados da banca']);
            exit;
        }

        if (!isset($data['id']) || $data['id'] == ''){
            $this->message (['erro' => 'O id da banca deve ser informado']);
            exit;
        }
        $dataSave = [
            'banca' => ( $data['banca'] ?? null )
        ];

        $result = $this->crud->update ('jury', $dataSave, ['id' => $data['id']]);
        if ($result === true) {
            $this->message (['aviso' => 'Registro salvo com sucesso']);
        } else {
            echo $result;
        }

    }

    public function deleteJury(): void
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);

        if (empty($data)) {
            $this->message (['erro' => 'A requisição deve conter os dados da banca']);
            exit;
        }

        if (!isset($data['id']) || $data['id'] == ''){
            $this->message (['erro' => 'O id da banca deve ser informado']);
            exit;
        }

        $result = $this->crud->delete ('jury', ['id' => $data['id']]);

        if ($result) {
            $this->message (['aviso' => 'Banca apagada']);
        } else {
            $this->message (['aviso' => $result]);
        }

    }

}