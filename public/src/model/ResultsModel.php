<?php


namespace aps\model;


class ResultsModel extends repository\crud
{
    private int $id;
    private int $id_usuario;
    private int $numero_questoes;
    private int $acertos;

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
     * @return int
     */
    public function getIdUsuario (): int
    {
        return $this->id_usuario;
    }

    /**
     * @param int $id_usuario
     */
    public function setIdUsuario (int $id_usuario): void
    {
        $this->id_usuario = $id_usuario;
    }

    /**
     * @return int
     */
    public function getNumeroQuestoes (): int
    {
        return $this->numero_questoes;
    }

    /**
     * @param int $numero_questoes
     */
    public function setNumeroQuestoes (int $numero_questoes): void
    {
        $this->numero_questoes = $numero_questoes;
    }

    /**
     * @return int
     */
    public function getAcertos (): int
    {
        return $this->acertos;
    }

    /**
     * @param int $acertos
     */
    public function setAcertos (int $acertos): void
    {
        $this->acertos = $acertos;
    }


}