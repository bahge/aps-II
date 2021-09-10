<?php


namespace aps\model;


use aps\model\repository\crud;

class UserModel extends crud
{
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
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode ($r);
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