<?php

namespace App\Controllers;

class AI extends BaseController
{
    public function chat()
    {
        $message = $this->request->getPost('message');

        $apiKey = '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';

        $data = [
            "model" => "openai/gpt-3.5-turbo",
            "messages" => [
                [
                    "role" => "system",
                    "content" => "Kamu adalah SIGAP AI, asisten kesehatan tentang diare. Jawab bahasa Indonesia, singkat, jelas, ramah."
                ],
                [
                    "role" => "user",
                    "content" => $message
                ]
            ]
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://openrouter.ai/api/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apiKey,
            'HTTP-Referer: https://sigapcoba.mikpolije.com',
            'X-Title: SIGAP AI'
        ]);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            return $this->response->setJSON([
                'answer' => curl_error($ch)
            ]);
        }

        curl_close($ch);

        $response = json_decode($result, true);

        if (isset($response['error'])) {
            return $this->response->setJSON([
                'answer' => '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>'
            ]);
        }

        $answer = $response['choices'][0]['message']['content'] ?? 'AI tidak merespons';

        return $this->response->setJSON([
            'answer' => nl2br($answer)
        ]);
    }
}