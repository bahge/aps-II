<?php


namespace aps\model;


class QuestionModel extends repository\crud
{
    private int $id;
    private string $pergunta;
    private array $respostas;
    private int $tipo_de_pergunta;

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
    public function getPergunta (): string
    {
        return $this->pergunta;
    }

    /**
     * @param string $pergunta
     */
    public function setPergunta (string $pergunta): void
    {
        $this->pergunta = $pergunta;
    }

    /**
     * @return array
     */
    public function getRespostas (): array
    {
        return $this->respostas;
    }

    /**
     * @param array $respostas
     */
    public function setRespostas (array $respostas): void
    {
        $this->respostas = $respostas;
    }

    /**
     * @return int
     */
    public function getTipoDePergunta (): int
    {
        return $this->tipo_de_pergunta;
    }

    /**
     * @param int $tipo_de_pergunta
     */
    public function setTipoDePergunta (int $tipo_de_pergunta): void
    {
        $this->tipo_de_pergunta = $tipo_de_pergunta;
    }


}