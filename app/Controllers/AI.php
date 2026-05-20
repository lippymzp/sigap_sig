<?php

namespace App\Controllers;

class AI extends BaseController
{
    public function chat()
    {
        $message = trim($this->request->getPost('message'));

        if (!$message) {
            return $this->response->setJSON([
                'answer' => 'Pesan kosong.'
            ]);
        }

        // API KEY GROQ
        $apiKey = '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';

        $payload = [
            "model" => "llama-3.1-8b-instant",
            "messages" => [
                [
                    "role" => "system",
                    "content" => "Kamu adalah DOXY AI, asisten kesehatan yang HANYA menjawab tentang penyakit diare, gejala diare, penyebab, pencegahan, pengobatan dasar. Jika ditanya di luar topik, tolak dengan sopan."
                ],
                [
                    "role" => "user",
                    "content" => $message
                ]
            ],
            "temperature" => 0.7,
            "max_tokens" => 500
        ];

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://api.groq.com/openai/v1/chat/completions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $apiKey,
                'Content-Type: application/json'
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
            return $this->response->setJSON([
                'answer' => nl2br($response['choices'][0]['message']['content'])
            ]);
        }

        return $this->response->setJSON([
            'answer' => '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>'
        ]);
    }
}