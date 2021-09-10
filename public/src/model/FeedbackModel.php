<?php


namespace aps\model;


class FeedbackModel extends repository\crud
{
    private int $id;
    private string $onde_avalia;
    private int $nota;
    private string $avaliacao;

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
    public function getOndeAvalia (): string
    {
        return $this->onde_avalia;
    }

    /**
     * @param string $onde_avalia
     */
    public function setOndeAvalia (string $onde_avalia): void
    {
        $this->onde_avalia = $onde_avalia;
    }

    /**
     * @return int
     */
    public function getNota (): int
    {
        return $this->nota;
    }

    /**
     * @param int $nota
     */
    public function setNota (int $nota): void
    {
        $this->nota = $nota;
    }

    /**
     * @return string
     */
    public function getAvaliacao (): string
    {
        return $this->avaliacao;
    }

    /**
     * @param string $avaliacao
     */
    public function setAvaliacao (string $avaliacao): void
    {
        $this->avaliacao = $avaliacao;
    }



}