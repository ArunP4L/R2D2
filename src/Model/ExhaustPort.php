<?php
declare(strict_types=1);

namespace Model;

class ExhaustPort
{
    /** @var int */
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->id;
    }
}
