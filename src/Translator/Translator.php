<?php
declare(strict_types=1);

namespace Translator;

interface Translator
{
    public function translate(string $data): string;
}
