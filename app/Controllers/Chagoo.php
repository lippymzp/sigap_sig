<?php

namespace App\Controllers;

class Chagoo extends BaseController
{
    public function index()
    {
        return view('gol_a/ChaGoo/chagoodbd');
    }

    public function send()
    {
        // ====================================================================
        // Sistem Anti-Spam (Jeda 5 Detik) Menggunakan Session
        // ====================================================================
        $session = session();
        $lastRequestTime = $session->get('last_chagoo_request');
        $currentTime = time();

        // Jika request kurang dari 5 detik dari request sebelumnya, tolak!
        if ($lastRequestTime && ($currentTime - $lastRequestTime) < 5) {
            return $this->response->setJSON([
                'reply' => 'Mohon tunggu sekitar 5 detik sebelum mengirim pertanyaan berikutnya.',
                'csrf_token' => csrf_hash() 
            ]);
        }
        
        // Simpan waktu request terbaru ke session
        $session->set('last_chagoo_request', $currentTime);

        $message = trim((string) $this->request->getPost('message'));

        if (empty($message)) {
            return $this->response->setJSON([
                'reply' => 'Silakan masukkan pertanyaan terlebih dahulu.',
                'csrf_token' => csrf_hash() 
            ]);
        }

        // Panggil fungsi API Groq
        $reply = $this->generateReplyGroq($message);

        return $this->response->setJSON([
            'reply' => $reply,
            'csrf_token' => csrf_hash() 
        ]);
    }

    private function generateReplyGroq($msg)
    {
        // API Key Groq
        $apiKey = 'gsk_HkkNs6HEZiU7oxnIlYIYWGdyb3FYGetrdnASXWw5gzgB9bo7DY5'; 
        
        // ====================================================================
        // SETUP URL & PERTANYAAN FORMAT GROQ
        // ====================================================================
        $url = 'https://api.groq.com/openai/v1/chat/completions';

        // INSTRUKSI: Menambahkan aturan tidak boleh pakai bintang dan maksimal 1 paragraf
        $systemInstruction = "Anda adalah ChaGoo Bot, asisten ahli medis profesional yang SECARA EKSKLUSIF memberikan edukasi tentang Demam Berdarah Dengue (DBD). "
            . "TUGAS UTAMA: Anda HANYA boleh menjawab pertanyaan yang berkaitan dengan DBD (definisi, etiologi, patofisiologi, manifestasi klinis, pemeriksaan lab, pengobatan, pencegahan 3M Plus, dsb). "
            . "ATURAN MUTLAK: Jika pengguna bertanya tentang topik di luar DBD (penyakit lain, resep masakan, cuaca, coding, dll), Anda WAJIB MENOLAK dengan sopan dan mengingatkan bahwa Anda hanya melayani pertanyaan seputar DBD. "
            . "ATURAN FORMAT: DILARANG KERAS menggunakan tanda bintang di dalam jawaban untuk alasan apapun. Jawaban Anda HARUS singkat, padat, dan terdiri dari MAKSIMAL 1 PARAGRAF saja.";

        // Format payload untuk Groq API (Mirip OpenAI)
        $data = [
            // PERUBAHAN ADA DI SINI: Menggunakan model Llama 3.1 versi terbaru
            "model" => "llama-3.1-8b-instant", 
            "messages" => [
                [
                    "role" => "system",
                    "content" => $systemInstruction
                ],
                [
                    "role" => "user",
                    "content" => $msg
                ]
            ],
            "temperature" => 0.2, 
            "max_tokens" => 800
        ];

        $jsonData = json_encode($data);

        // ====================================================================
        // EKSEKUSI DENGAN FITUR "AUTO-RETRY"
        // ====================================================================
        $maxRetries = 2; // Coba maksimal 2 kali
        $retryDelay = 2; // Tunggu 2 detik jika gagal

        for ($i = 0; $i < $maxRetries; $i++) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $apiKey
            ]);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            // Jika sukses (200 OK), langsung kembalikan jawaban ke pengguna
            if ($httpCode == 200) {
                $responseData = json_decode($response, true);
                if (isset($responseData['choices'][0]['message']['content'])) {
                    // Mencegah kebocoran karakter bintang dan merapikan teks
                    $finalReply = trim($responseData['choices'][0]['message']['content']);
                    $finalReply = str_replace('*', '', $finalReply);
                    return $finalReply;
                }
            }

            // Jika error 503 (Server Penuh) atau 429 (Terlalu Cepat/Limit)
            if ($httpCode == 503 || $httpCode == 429) {
                if ($i < $maxRetries - 1) {
                    sleep($retryDelay); 
                    continue; 
                } else {
                    if ($httpCode == 429) {
                        return "Mohon tunggu sebentar. Anda mengirim pertanyaan terlalu cepat. Jeda beberapa detik sebelum bertanya lagi.";
                    } else {
                        return "Maaf, server AI sedang sibuk. Silakan coba tanyakan kembali dalam beberapa detik.";
                    }
                }
            }

            // Jika ada error lainnya
    
            //return "Terjadi kendala pada server Groq (Kode: $httpCode). Bantuan teknis: " . $response;
        }

        return "Maaf, ChaGoo tidak dapat memproses jawaban saat ini.";
    }
}