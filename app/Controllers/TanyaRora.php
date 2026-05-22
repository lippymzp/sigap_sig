<?php

namespace App\Controllers;

class TanyaRora extends BaseController
{
    public function ask()
    {
        // Ambil pesan user dari request JSON
        $input = $this->request->getJSON();
        $userMessage = $input->message ?? '';

        // Ambil API Key dari .env
        $apiKey = getenv('OPENAI_API_KEY');

        // Payload untuk API Gemini/OpenAI
        $data = [
            'model' => 'gemini-pro', // Bisa ganti dengan model lain sesuai akunmu
            'input' => [
                ['role' => 'user', 'content' => $userMessage]
            ],
            'max_output_tokens' => 256
        ];

        // CURL request ke API
        $ch = curl_init('https://api.openai.com/v1/experiments/generate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apiKey
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $resp = curl_exec($ch);
        curl_close($ch);

        // Parse response JSON
        $result = json_decode($resp, true);

        // Ambil reply, jika tidak ada fallback message
        $reply = $result['output'][0]['content'][0]['text'] ?? "Maaf, Rora belum mengerti 🙏";

        // Kirim balik ke frontend sebagai JSON
        return $this->response->setJSON(['reply' => $reply]);
    }
}