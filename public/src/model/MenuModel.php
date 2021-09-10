<?php


namespace aps\model;


class MenuModel extends repository\crud
{
    private int $id;
    private string $link;
    private string $text;

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
    public function getLink (): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink (string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getText (): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText (string $text): void
    {
        $this->text = $text;
    }


}