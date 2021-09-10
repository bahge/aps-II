<?php


namespace aps\model;


class AnswersModel extends repository\crud
{
    private int $id;
    private string $justificativa;
    private int $tipo_de_pergunta;
    private int $id_da_questao;
    private int $opcao_correta;

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
    public function getJustificativa (): string
    {
        return $this->justificativa;
    }

    /**
     * @param string $justificativa
     */
    public function setJustificativa (string $justificativa): void
    {
        $this->justificativa = $justificativa;
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

    /**
     * @return int
     */
    public function getIdDaQuestao (): int
    {
        return $this->id_da_questao;
    }

    /**
     * @param int $id_da_questao
     */
    public function setIdDaQuestao (int $id_da_questao): void
    {
        $this->id_da_questao = $id_da_questao;
    }

    /**
     * @return int
     */
    public function getOpcaoCorreta (): int
    {
        return $this->opcao_correta;
    }

    /**
     * @param int $opcao_correta
     */
    public function setOpcaoCorreta (int $opcao_correta): void
    {
        $this->opcao_correta = $opcao_correta;
    }




}