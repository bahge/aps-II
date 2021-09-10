<?php


namespace aps\model;


class RoleModel extends repository\crud
{
    private int $id;
    private string $cargo;

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
    public function getCargo (): string
    {
        return $this->cargo;
    }

    /**
     * @param string $cargo
     */
    public function setCargo (string $cargo): self
    {
        $this->cargo = $cargo;
        return $this->cargo;
    }


}