<?php


namespace aps\model;


class CommentsModel extends repository\crud
{
    private int $id;
    private string $onde_comenta;
    private string $comentario;

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
    public function getOndeComenta (): string
    {
        return $this->onde_comenta;
    }

    /**
     * @param string $onde_comenta
     */
    public function setOndeComenta (string $onde_comenta): void
    {
        $this->onde_comenta = $onde_comenta;
    }

    /**
     * @return string
     */
    public function getComentario (): string
    {
        return $this->comentario;
    }

    /**
     * @param string $comentario
     */
    public function setComentario (string $comentario): void
    {
        $this->comentario = $comentario;
    }



}