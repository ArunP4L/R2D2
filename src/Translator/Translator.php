<?php
declare(strict_types=1);

namespace Translator;

interface Translator
{
    /**
     * @param string $data
     * @return string
     */
    public function translate(string $data): string;
}
