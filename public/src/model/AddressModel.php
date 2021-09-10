<?php


namespace aps\model;


class AddressModel extends repository\crud
{
    private int $id;
    private string $logradouro;
    private string $numero;
    private string $cidade;
    private string $uf;
    private string $cep;

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
    public function getLogradouro (): string
    {
        return $this->logradouro;
    }

    /**
     * @param string $logradouro
     */
    public function setLogradouro (string $logradouro): void
    {
        $this->logradouro = $logradouro;
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
    public function setNumero (string $numero): void
    {
        $this->numero = $numero;
    }

    /**
     * @return string
     */
    public function getCidade (): string
    {
        return $this->cidade;
    }

    /**
     * @param string $cidade
     */
    public function setCidade (string $cidade): void
    {
        $this->cidade = $cidade;
    }

    /**
     * @return string
     */
    public function getUf (): string
    {
        return $this->uf;
    }

    /**
     * @param string $uf
     */
    public function setUf (string $uf): void
    {
        $this->uf = $uf;
    }

    /**
     * @return string
     */
    public function getCep (): string
    {
        return $this->cep;
    }

    /**
     * @param string $cep
     */
    public function setCep (string $cep): void
    {
        $this->cep = $cep;
    }


}