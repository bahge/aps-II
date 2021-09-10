<?php


namespace aps\model;


class ExamModel extends repository\crud
{
    private int $id;
    private string $simulado;

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
    public function getSimulado (): string
    {
        return $this->simulado;
    }

    /**
     * @param string $simulado
     */
    public function setSimulado (string $simulado): self
    {
        $this->simulado = $simulado;
        return $this->simulado;
    }


}