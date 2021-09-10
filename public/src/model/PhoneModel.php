<?php


namespace aps\model;


class PhoneModel extends repository\crud
{
    private int $id;
    private string $numero;

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
    public function getNumero (): string
    {
        return $this->numero;
    }

    /**
     * @param string $numero
     */
    public function setNumero (string $numero): self
    {
        $this->numero = $numero;
        return $thi->numero;
    }


}