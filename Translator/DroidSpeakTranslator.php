<?php
declare(strict_types=1);

use Translator\Translator;

class DroidSpeakTranslator implements Translator
{
    public function translator(string $data): string
    {
        return $data;
    }
}