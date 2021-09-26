<?php


namespace aps\model;


use aps\appcore\JsonMsg;
use aps\model\repository\crud;

class UserModel extends crud
{
    use JsonMsg;

    private int $id;
    private string $login;
    private string $pass;
    private string $cpf;
    private string $name;
    private string $area;
    private int $level;
    private crud $crud;

    private array $dados;

    /**
     * UserModel constructor.
     * @param int|null $id
     * @param string|null $login
     * @param string|null $pass
     * @param string|null $cpf
     * @param string|null $name
     * @param string|null $area
     * @param int|null $level
     */
    public function __construct ()
    {
        $this->crud = new crud();
    }

    public function listByLogin(string $login)
    {
        $user = $this->crud->read('user', 'WHERE login=:login LIMIT 1', 'login='. $login, null);
        return $user[0];
    }

    public function listById(int $id)
    {
        $user = $this->crud->read('user', 'WHERE id=:id', 'id='. $id, null);
        return $user[0];
    }

    public function listAll()
    {
        $this->dados = $this->crud->read ('user', null, null, null);
        $r = [];
        foreach ($this->dados as $users){
            $user = [
                'id' => $users['id'],
                'login' => $users['login'],
                'name' => $users['name'],
                'level' => ($users['level'] == 0 ? "Usuário" : "Admin" ),
            ];
            array_push ($r, $user);
        }
        $this->message ($r);
    }

    public function editById(int $id, array $data = null)
    {
        if (is_null ($data)){
            return $this->listById ($id);
        }
    }

    public function newUser(): void
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);

        $dataSave = [
            'id' => ( $data['id'] ?? null ),
            'login' => ( $data['login'] ?? null ),
            'pass' => ( $data['pass'] ?? null ),
            'cpf' => ( $data['cpf'] ?? null ),
            'name' => ( $data['name'] ?? null ),
            'area' => ( $data['area'] ?? null ),
            'level' => ( $data['level'] ?? 0 )
        ];

        if (!is_null($dataSave['pass'])){
            $dataSave['pass'] = password_hash ($dataSave['pass'], PASSWORD_BCRYPT);
        }
        $result = $this->crud->insert ('user', $dataSave);
        if ($result === true) {
            $this->message (['aviso' => 'Registro salvo com sucesso']);
        } else {
            echo $result;
        }

    }

    public function updateUser(): void
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
        $dataSave = [
            'login' => ( $data['login'] ?? null ),
            'cpf' => ( $data['cpf'] ?? null ),
            'name' => ( $data['name'] ?? null ),
            'area' => ( $data['area'] ?? null )
        ];

        $result = $this->crud->update ('user', $dataSave, ['id' => $data['id']]);
        if ($result === true) {
            $this->message (['aviso' => 'Registro salvo com sucesso']);
        } else {
            echo $result;
        }

    }

    public function deleteUser(): void
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

        $result = $this->crud->delete ('user', ['id' => $data['id']]);

        if ($result) {
            $this->message (['aviso' => 'Usuário apagado']);
        } else {
            $this->message (['aviso' => $result]);
        }

    }

    public function saveNewPass(): void
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);

        if (empty($data)) {
            $this->message (['erro' => 'A requisição deve conter os dados da nova senha']);
            exit;
        }

        if (!isset($data['id']) || $data['id'] == ''){
            $this->message (['erro' => 'O id do usuário deve ser informado']);
            exit;
        }

        $dataUpdate = [
            'id' => ( $data['id_rec'] ?? null )
        ];

        $r = $this->crud->delete ('passrecovery', ['id' => $dataUpdate['id']]);

        $dataSave = [
            'pass' => ( $data['pass'] ?? null )
        ];

        if (!is_null($dataSave['pass'])){
            $dataSave['pass'] = password_hash ($dataSave['pass'], PASSWORD_BCRYPT);
        }

        $result = $this->crud->update ('user', $dataSave, ['id' => $data['id']]);
        if ($result === true && $r === true) {
            $this->message (['aviso' => 'Registro salvo com sucesso']);
        } else {
            $this->message (['aviso' => $result['erro']]);
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
     * @return string
     */
    public function getLogin (): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin (string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPass (): string
    {
        return $this->pass;
    }

    /**
     * @param string $pass
     */
    public function setPass (string $pass): void
    {
        $this->pass = $pass;
    }

    /**
     * @return string
     */
    public function getCpf (): string
    {
        return $this->cpf;
    }

    /**
     * @param string $cpf
     */
    public function setCpf (string $cpf): void
    {
        $this->cpf = $cpf;
    }

    /**
     * @return string
     */
    public function getName (): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName (string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getArea (): string
    {
        return $this->area;
    }

    /**
     * @param string $area
     */
    public function setArea (string $area): void
    {
        $this->area = $area;
    }

    /**
     * @return int
     */
    public function getLevel (): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel (int $level): void
    {
        $this->level = $level;
    }
}