<?php

namespace App\Controllers;

class AI extends BaseController
{
    public function chat()
    {
        $message = $this->request->getPost('message');

        // GANTI DENGAN API KEY BARU
        $apiKey = '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';

        $data = [
            "model" => "meta-llama/llama-3.1-8b-instruct:free",
            "messages" => [
                [
                    "role" => "system",
                    "content" => "Kamu adalah SIGAP AI, asisten kesehatan khusus penyakit diare. Jawab singkat, jelas, ramah, dalam bahasa Indonesia."
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
            CURLOPT_TIMEOUT => 30,
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
            $answer = '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        }

        return $this->response->setJSON([
            'answer' => nl2br($answer)
        ]);
    }
}