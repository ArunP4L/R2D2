<?php
declare(strict_types=1);

namespace Translator;

class DroidSpeakTranslator implements Translator
{

    /**
     * @param string $value
     * @return bool
     */
    private function valid(string $value): bool
    {
        return preg_match('/^([01]{8} ?)*$/m',$value) === 1;
    }

    /**
     * @param string $data
     * @return string
     * @throws \Exception
     */
    public function translate(string $data): string
    {
        if (!$this->valid($data)) {
            throw new \Exception('Invalid binary string');
        }
        
        return implode('', array_map(function(string $value) {
            return chr(bindec($value));
        }, explode(' ', $data)));
    }
}
