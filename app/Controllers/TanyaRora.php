<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class TanyaRora extends Controller
{
    public function tanyaRora()
    {
        $input   = $this->request->getJSON(true);
        $message = trim($input['message'] ?? '');

        if (empty($message)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'Pesan tidak boleh kosong.']);
        }

        // Fix: tambah fallback getenv()
        $apiKey = env('OPENAI_API_KEY') ?: getenv('OPENAI_API_KEY');

        // DEBUG SEMENTARA — hapus setelah selesai debug
        log_message('debug', 'API Key ada: ' . ($apiKey ? 'YA' : 'TIDAK'));

        if (empty($apiKey)) {
            log_message('error', 'OPENAI_API_KEY tidak ditemukan');
            return $this->response
                ->setStatusCode(500)
                ->setJSON(['error' => 'Konfigurasi API key tidak ditemukan.']);
        }

      $payload = json_encode([
    'model' => 'gpt-4o-mini',
    'messages' => [
        [
            'role' => 'system',
            'content' => 'Kamu adalah chatbot Rora, ramah dan informatif. Jawab pertanyaan tentang Tuberkulosis dalam bahasa Indonesia yang mudah dipahami.'
        ],
        [
            'role' => 'user',
            'content' => $message
        ]
    ],
    'max_tokens' => 1024
]);

        $ch = curl_init('https://api.openai.com/v1/chat/completions');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $apiKey,
            ],
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $response   = curl_exec($ch);
        $curlError  = curl_error($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Tangkap curl error
        if ($curlError) {
            log_message('error', 'CURL Error: ' . $curlError);
            return $this->response
                ->setStatusCode(500)
                ->setJSON(['error' => 'Koneksi ke AI gagal: ' . $curlError]);
        }

        if ($httpStatus !== 200) {
            log_message('error', 'OpenAI HTTP ' . $httpStatus . ': ' . $response);
            return $this->response
                ->setStatusCode(500)
                ->setJSON(['error' => 'Gagal menghubungi AI (HTTP ' . $httpStatus . ').']);
        }

        $data  = json_decode($response, true);
        $reply = $data['choices'][0]['message']['content'] ?? 'Maaf, aku tidak bisa menjawab saat ini.';

        return $this->response->setJSON(['reply' => $reply]);
    }
}