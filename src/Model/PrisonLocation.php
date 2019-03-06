<?php
declare(strict_types=1);

namespace Model;

use RuntimeException;

class PrisonLocation
{
    const CELL = 'cell';
    const BLOCK = 'block';

    /** @var string */
    private $cell;
    /** @var string */
    private $block;

    private function __construct(string $cell, string $block)
    {

        $this->cell = $cell;
        $this->block = $block;
    }

    public static function buildFromArray(Array $data) {
        if (!in_array(self::CELL, $data) || !in_array(self::BLOCK, $data)) {
            throw new RuntimeException('Invalid data passed to builder method.');
        }

        return new self($data[self::CELL], $data[self::BLOCK]);
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
