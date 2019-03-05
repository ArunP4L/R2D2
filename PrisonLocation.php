<?php
declare(strict_types=1);

class PrisonLocation
{
    /** @var string */
    private $cell;
    /** @var string */
    private $block;

    public function __construct(string $cell, string $block)
    {

        $this->cell = $cell;
        $this->block = $block;
    }

    /**
     * @return string
     */
    public function getCell(): string
    {
        return $this->cell;
    }

    /**
     * @return string
     */
    public function getBlock(): string
    {
        return $this->block;
    }
}