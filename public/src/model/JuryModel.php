<?php


namespace aps\model;


class JuryModel extends repository\crud
{
    private int $id;
    private string $banca;

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
    public function getBanca (): string
    {
        return $this->banca;
    }

    /**
     * @param string $banca
     */
    public function setBanca (string $banca): self
    {
        $this->banca = $banca;
        return $this->banca;
    }


}