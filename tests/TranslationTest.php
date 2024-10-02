<?php

namespace Aditya7\NepaliTranslator\Tests;

use Aditya7\NepaliTranslator\Facades\NepaliTranslator;
use Aditya7\NepaliTranslator\Translation;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Mockery;
use Orchestra\Testbench\TestCase;

class TranslationTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            \Aditya7\NepaliTranslator\NepaliTranslatorServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'NepaliTranslator' => \Aditya7\NepaliTranslator\Facades\NepaliTranslator::class,
        ];
    }

    public function testTranslationReturnsCachedValue()
    {
        Cache::shouldReceive('has')->andReturn(true);
        Cache::shouldReceive('get')->andReturn('नमस्ते');

        $translation = NepaliTranslator::translate('Hello');

        $this->assertEquals('नमस्ते', $translation);
    }

    public function testTranslationMakesApiCall()
    {
        Cache::shouldReceive('has')->andReturn(false);
        Cache::shouldReceive('put')->once();

        $mockClient = Mockery::mock(ClientInterface::class);
        $mockClient->shouldReceive('post')->andReturn(
            new \GuzzleHttp\Psr7\Response(200, [], json_encode(['translated_text' => 'नमस्ते']))
        );

        $this->app->singleton('nepalitranslator', function ($app) use ($mockClient) {
            return new Translation($mockClient);
        });

        $translation = NepaliTranslator::translate('Hello');

        $this->assertEquals('नमस्ते', $translation);
    }
}