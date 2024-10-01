<?php

namespace 7aditya7\NepaliTranslator;

use PHPUnit\Framework\TestCase;
use YourName\NepaliTranslator\Translation;

class TranslationTest extends TestCase
{
    public function testTranslation()
    {
        $translator = new Translation();
        $translatedText = $translator->translate('hello world');
        $this->assertEquals('नमस्ते संसार', $translatedText);
    }
}