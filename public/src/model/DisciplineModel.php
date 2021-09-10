<?php


namespace aps\model;


class DisciplineModel extends repository\crud
{
    private int $id;
    private string $disciplina;

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
    public function getDisciplina (): string
    {
        return $this->disciplina;
    }

    /**
     * @param string $disciplina
     */
    public function setDisciplina (string $disciplina): self
    {
        $this->disciplina = $disciplina;
        return $this->disciplina;
    }


}