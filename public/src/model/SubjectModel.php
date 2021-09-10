<?php


namespace aps\model;


class SubjectModel extends repository\crud
{
    private int $id;
    private string $assunto;

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