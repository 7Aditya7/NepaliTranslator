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
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->apiKey,
                ],
                'json' => [
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'Translate the provided English text into Nepali. Ensure the translation is accurate, natural, and concise. The output must be entirely in Nepali with no English words included. Do not provide any additional context, explanations, alternatives, or suggestions. Focus solely on providing the most direct and appropriate translation in Nepali without extra information or clarification.',
                        ],
                        [
                            'role' => 'user',
                            'content' => $text,
                        ],
                        [
                            'role' => 'assistant',
                            'content' => 'nepali',
                        ],
                    ],
                    'model' => 'llama3-groq-70b-8192-tool-use-preview',
                    'temperature' => 1,
                    'max_tokens' => 1024,
                    'top_p' => 1,
                    'stream' => false,
                    'stop' => null,
                ],
                'timeout' => 5, // Timeout after 5 seconds
            ]);

            $data = json_decode($response->getBody(), true);

            if (isset($data['choices'][0]['message']['content'])) {
                $translatedText = $data['choices'][0]['message']['content'];

                // Store in cache for 24 hours
                Cache::put($cacheKey, $translatedText, now()->addDay());

                return $translatedText;
            } else {
                Log::error('Translation API response missing expected content.', $data);
                return $text; // Return original text if translation fails
            }
        } catch (\Exception $e) {
            Log::error('Translation API error: ' . $e->getMessage());
            return $text; // Return original text in case of error
        }
    }
}
