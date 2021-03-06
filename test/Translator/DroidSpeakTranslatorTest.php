<?php
declare(strict_types=1);

namespace test\Translator;

use PHPUnit\Framework\TestCase;
use Translator\DroidSpeakTranslator;
use Translator\Translator;

class DroidSpeakTranslatorTest extends TestCase
{
    /** @var Translator */
    private $translator;

    protected function setUp(): void
    {
        $this->translator = new DroidSpeakTranslator();
    }

    public function testItTranslateWithValidInput()
    {
        $input = '01000011 01100101 01101100 01101100 00100000 00110010 00110001 00111000 00110111';
        $expected = 'Cell 2187';

        $value = $this->translator->translate($input);

        $this->assertEquals($expected, $value);
    }

    public function testItThrowsAnExceptionWhenGivenInvalidBinary()
    {
        $this->expectException(\Exception::class);

        $input = '01000011 01100101 01101100 01101100 00120000 00110010 00110001 00111000 00110111';

        $this->translator->translate($input);
    }

}
