<?php


namespace aps\model;

use aps\appcore\JsonMsg;
use aps\model\repository\crud;

class SubjectModel extends crud
{
    use JsonMsg;

    private int $id;
    private string $assunto;
    private array $dados;
    private crud $crud;

    public function __construct ()
    {
        $this->crud = new crud();
    }

    public function listById(int $id)
    {
        $suject = $this->crud->read('subject', 'WHERE id=:id', 'id='. $id, null);
        return $suject[0];
    }

    public function listAll(int $txt = null)
    {
        $this->dados = $this->crud->read ('subject', null, null, null);
        $r = [];
        foreach ($this->dados as $subjects){
            $subject = [
                'id' => $subjects['id'],
                'assunto' => $subjects['assunto']
            ];
            array_push ($r, $subject);
        }
        if (is_null ($txt)){
            $this->message ($r);
        } else {
            return $r;
        }

    }

    public function editById(int $id, array $data = null)
    {
        if (is_null ($data)){
            return $this->listById ($id);
        }
    }

    public function newSubject(): void
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);

        $dataSave = [
            'id' => ( $data['id'] ?? null ),
            'assunto' => ( $data['assunto'] ?? null )
        ];

        $result = $this->crud->insert ('subject', $dataSave);
        if ($result === true) {
            $this->message (['aviso' => 'Registro salvo com sucesso']);
        } else {
            echo $result;
        }
    }

    public function updateSubject(): void
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);

        if (empty($data)) {
            $this->message (['erro' => 'A requisição deve conter os dados do assunto']);
            exit;
        }

        if (!isset($data['id']) || $data['id'] == ''){
            $this->message (['erro' => 'O id do assunto deve ser informado']);
            exit;
        }
        $dataSave = [
            'assunto' => ( $data['assunto'] ?? null )
        ];

        $result = $this->crud->update ('subject', $dataSave, ['id' => $data['id']]);
        if ($result === true) {
            $this->message (['aviso' => 'Registro salvo com sucesso']);
        } else {
            echo $result;
        }

    }

    public function deleteSubject(): void
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);

        if (empty($data)) {
            $this->message (['erro' => 'A requisição deve conter os dados do usuário']);
            exit;
        }

        if (!isset($data['id']) || $data['id'] == ''){
            $this->message (['erro' => 'O id do usuário deve ser informado']);
            exit;
        }

        $result = $this->crud->delete ('subject', ['id' => $data['id']]);

        if ($result) {
            $this->message (['aviso' => 'Assunto apagado']);
        } else {
            $this->message (['aviso' => $result]);
        }

    }

    /**
     * @return int
     */
    public function getId (): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId (int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getAssunto (): string
    {
        return $this->assunto;
    }

    /**
     * @param string $assunto
     */
    public function setAssunto (string $assunto): self
    {
        $this->assunto = $assunto;
        return $this->assunto;
    }


}