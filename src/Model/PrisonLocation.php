<?php
declare(strict_types=1);

namespace Model;

use RuntimeException;

class PrisonLocation
{
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
        if (!array_key_exists('cell', $data) || !array_key_exists('block', $data)) {
            throw new RuntimeException('Invalid data passed to builder method.');
        }

        return new self($data['cell'], $data['block']);
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
