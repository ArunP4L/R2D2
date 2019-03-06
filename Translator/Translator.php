<?php
declare(strict_types=1);

namespace Translator;

interface Translator
{
    public function translator(string $data): string;
}