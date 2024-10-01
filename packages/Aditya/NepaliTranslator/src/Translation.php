<?php

namespace Aditya\NepaliTranslator;

class Translation
{
    protected $dictionary;

    public function __construct()
    {
        // Load your dictionary from the config
        $this->dictionary = config('nepali_translator.dictionary', []);
    }

    public function translate($text)
    {
        $words = explode(' ', $text);
        $translatedWords = array_map(function ($word) {
            return $this->dictionary[$word] ?? $word;
        }, $words);

        return implode(' ', $translatedWords);
    }
}