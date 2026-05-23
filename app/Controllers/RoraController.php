<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionAudio;

class RoraController extends ResourceController
{
    public function chat()
    {
        $input = $this->request->getJSON();
        $userMessage = $input->message ?? '';

        if (empty($userMessage)) {
            return $this->respond(['reply' => 'Pesan tidak boleh kosong.'], 400);
        }

        // Ganti baris $apiKey = getenv('GEMINI_API_KEY'); dengan baris di bawah ini:
        $apiKey = getenv('GROQ_API_KEY') ?: env('GROQ_API_KEY');

        // Pilihan Cadangan / Fail-safe (Hanya jika getenv masih membandel kosong):
        if (empty($apiKey)) {
        }

        // 2. Gunakan URL endpoint kompatibilitas OpenAI milik Google
        $url = 'https://api.groq.com/openai/v1/chat/completions';

        // 3. Gunakan nama model resmi Gemini yang valid (Disarankan: gemini-2.5-flash)
        $payload = [
            'model' => 'llama-3.3-70b-versatile',
            'messages' => [
                // 1. TAMBAHKAN PERINTAH SISTEM INI DI ATAS PESAN USER
                [
                    'role' => 'system',
                    'content' => 'Kamu adalah asisten chatbot yang cerdas. Kamu WAJIB selalu menjawab dan merespons dalam Bahasa Indonesia yang baik, santun, dan mudah dipahami, apa pun bahasa yang digunakan oleh user.'
                ],
                // 2. Ini pesan dari user yang sudah ada sebelumnya
                [
                    'role' => 'user',
                    'content' => $userMessage
                ]
            ]
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            // API key Gemini dimasukkan sebagai Bearer token di sini
            "Authorization: Bearer $apiKey"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            return $this->respond(['reply' => 'Maaf, server error: ' . $err], 500);
        }

        $data = json_decode($response, true);

        // Default fallback
        $reply = 'Gagal merespon. Raw Response: ' . substr($response, 0, 100);

        if (
            (isset($data['error']['code']) && $data['error']['code'] == 503) ||
            (isset($data[0]['error']['code']) && $data[0]['error']['code'] == 503) ||
            strpos($response, '"code": 503') !== false
        ) {
            $reply = 'Maaf, layanan sedang sibuk. Silakan coba beberapa detik lagi.';
        } elseif (!empty($data['choices'][0]['message']['content'])) {
            $reply = trim($data['choices'][0]['message']['content']);
        } elseif (isset($data['error']['message'])) {
            $reply = 'Error dari Google: ' . $data['error']['message'];
        }



        return $this->respond(['reply' => $reply]);
    }

  



  public function voiceToText()
{
    $audio = $this->request->getFile('audio');
    if (!$audio || !$audio->isValid()) {
        return $this->response->setJSON(['text' => '', 'error' => 'File audio korup atau kosong.']);
    }

    $tmpPath = $audio->getTempName();

    $client = new SpeechClient([
        'credentials' => WRITEPATH.'Config/google-service-account.json'
    ]);

    // SETTING BARU: Dicocokkan dengan WAV 16kHz dari Javascript
    $config = new RecognitionConfig([
        'encoding' => RecognitionConfig\AudioEncoding::LINEAR16,
        'sampleRateHertz' => 16000,
        'languageCode' => 'id-ID'
    ]);
    
    $audioData = new RecognitionAudio();
    $audioData->setContent(file_get_contents($tmpPath));

    try {
        $response = $client->recognize($config, $audioData);

        $transcribedText = '';
        foreach ($response->getResults() as $result) {
            $transcribedText .= $result->getAlternatives()[0]->getTranscript();
        }

        $client->close();
        return $this->response->setJSON(['text' => $transcribedText]);

    } catch (\Exception $e) {
        $client->close();
        return $this->response->setJSON(['text' => '', 'error' => $e->getMessage()]);
    }
}

}