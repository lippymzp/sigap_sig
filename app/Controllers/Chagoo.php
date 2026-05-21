<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Chagoo extends BaseController
{
    public function send()
    {
        // Pastikan request datang dari AJAX
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'error' => 'Akses ditolak. Permintaan harus menggunakan AJAX.'
            ])->setStatusCode(403);
        }

        $message = $this->request->getPost('message');
        
        // Validasi input
        if (empty($message)) {
            return $this->response->setJSON([
                'reply' => 'Pesan tidak boleh kosong.',
                'csrf_token' => csrf_hash()
            ]);
        }

        // Ambil API Key dari Constants
        // Pastikan Anda sudah mendefinisikan GROQ_API_KEY di app/Config/Constants.php
        $apiKey = defined('GROQ_API_KEY') ? GROQ_API_KEY : '';

        if (empty($apiKey)) {
            return $this->response->setJSON([
                'reply' => 'Sistem error: API Key Groq belum dikonfigurasi.',
                'csrf_token' => csrf_hash()
            ]);
        }

        // Endpoint Groq API (Kompatibel dengan format OpenAI)
        $url = 'https://api.groq.com/openai/v1/chat/completions';

        // System prompt yang diperketat untuk membatasi topik dan panjang karakter
        $systemPrompt = "Kamu adalah Chagoo, asisten medis AI spesialis Demam Berdarah Dengue (DBD). "
            . "ATURAN MUTLAK YANG HARUS KAMU PATUHI: "
            . "1. Kamu HANYA boleh membahas seputar penyakit DBD (Dasar Penyakit, Gejala, Fase Klinis, Penanganan, Pencegahan/3M Plus, dan Patofisiologi). "
            . "2. Tolak dengan sopan semua pertanyaan di luar topik DBD. "
            . "3. JAWAB HANYA DALAM 1 PARAGRAF SINGKAT (maksimal 3-4 kalimat yang padat dan jelas). "
            . "4. Langsung berikan jawaban (to the point) sesuai pertanyaan tanpa basa-basi panjang. "
            . "Gunakan bahasa Indonesia yang profesional namun mudah dipahami.";

        $data = [
            'model' => 'llama-3.1-8b-instant', // Atau model yang sedang Anda gunakan
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $systemPrompt
                ],
                [
                    'role' => 'user',
                    'content' => $message
                ]
            ],
            'temperature' => 0.2, // Turunkan sedikit agar AI lebih kaku dan mematuhi format 1 paragraf
            'max_tokens' => 200,  // Batasi token output agar AI tidak bisa menulis terlalu panjang
        ];

        // Eksekusi cURL ke Groq API
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $apiKey,
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

       if ($curlError || $httpCode != 200) {
            $debugMessage = "cURL Error: " . ($curlError ?: 'Tidak ada') . 
                            " | HTTP Code: " . $httpCode . 
                            " | Response: " . $response;
                            
            return $this->response->setJSON([
                'reply' => 'DITOLAK HOSTING: ' . $debugMessage,
                'csrf_token' => csrf_hash() 
            ]);
        }

        $responseData = json_decode($response, true);
        $aiReply = $responseData['choices'][0]['message']['content'] ?? 'Maaf, saya tidak mengerti pertanyaan tersebut.';

        // Siapkan opsi balasan cepat (Quick Replies)
        $options = [];
        
        // Jika ini adalah sapaan awal (halo) dari JS, berikan opsi menu DBD
        if (strtolower(trim($message)) === 'halo') {
            $options = [
                'Apa itu DBD?', 
                'Gejala Awal DBD', 
                'Cara Pencegahan (3M Plus)', 
                'Pertolongan Pertama'
            ];
        }

        // Kembalikan response JSON sesuai yang diharapkan oleh chagoodbd.php
        return $this->response->setJSON([
            'reply' => $aiReply,
            'options' => $options,
            'csrf_token' => csrf_hash() // Penting agar fetch selanjutnya tidak error 403 CSRF
        ]);
    }
}