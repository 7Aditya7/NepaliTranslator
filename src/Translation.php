<?php

namespace Aditya7\NepaliTranslator;

use GuzzleHttp\ClientInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class Translation
{
    protected $client;
    protected $apiEndpoint;
    protected $apiKey;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
        $this->apiEndpoint = config('nepalitranslator.api_endpoint');
        $this->apiKey = config('nepalitranslator.api_key');
    }

    public function translate(string $text): ?string
    {
        $cacheKey = 'nepali_translation_' . md5($text);

        // Check if translation exists in cache
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        try {
            $response = $this->client->post($this->apiEndpoint, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Accept'        => 'application/json',
                ],
                'json' => [
                    'text' => $text,
                    'target_language' => 'ne', // Assuming 'ne' is the code for Nepali
                ],
                'timeout' => 5, // Timeout after 5 seconds
            ]);

            $data = json_decode($response->getBody(), true);

            if (isset($data['translated_text'])) {
                $translatedText = $data['translated_text'];

                // Store in cache for 24 hours
                Cache::put($cacheKey, $translatedText, now()->addDay());

                return $translatedText;
            } else {
                Log::error('Translation API response missing translated_text.', $data);
                return null;
            }
        } catch (\Exception $e) {
            Log::error('Translation API error: ' . $e->getMessage());
            return null;
        }
    }
}
