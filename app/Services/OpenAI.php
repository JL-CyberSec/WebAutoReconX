<?php

namespace App\Services;

use GuzzleHttp\Client;

class OpenAI
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.openai.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . config('scan.openai_api_key'),
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function chat($json, $model = 'gpt-3.5-turbo')
    {
        if (! config('scan.use_ia')) {
            return "AI recommendations are disabled.";
        }

        $prompt = str_replace('{data}', $json, config('scan.prompt'));

        $response = $this->client->post('chat/completions', [
            'json' => [
                'model' => $model,
                'messages' => [
                    ['role' => 'system', 'content' => 'You are an expert in cibersecurity.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        return $data['choices'][0]['message']['content'];
    }
}
