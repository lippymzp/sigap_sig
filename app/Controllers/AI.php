<?php

namespace App\Controllers;

class AI extends BaseController
{
    public function chat()
    {
        $message = $this->request->getPost('message');

        $apiKey = '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';

        $data = [
            "model" => "openai/gpt-3.5-turbo-instruct",
            "messages" => [
                [
                    "role" => "system",
                    "content" => "Kamu adalah SIGAP AI, asisten kesehatan tentang diare. Jawab singkat, jelas, ramah, bahasa Indonesia."
                    
                ],
                [
                    "role" => "user",
                    "content" => $message
                ]
            ]
        ];

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://openrouter.ai/api/v1/chat/completions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $apiKey,
                'HTTP-Referer: https://sigapcoba.mikpolije.com',
                'X-Title: SIGAP AI'
            ]
        ]);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            return $this->response->setJSON([
                'answer' => 'CURL ERROR: ' . curl_error($ch)
            ]);
        }

        curl_close($ch);

        $response = json_decode($result, true);

        if (isset($response['choices'][0]['message']['content'])) {
            $answer = $response['choices'][0]['message']['content'];
        } else {
            $answer = 'ERROR: <pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        }

        return $this->response->setJSON([
            'answer' => nl2br($answer)
        ]);
    }
}