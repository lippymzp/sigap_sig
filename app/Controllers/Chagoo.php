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
        try {
            // ====================================================================
            // Sistem Anti-Spam (Jeda 5 Detik) Menggunakan Session
            // ====================================================================
            $session = session();
            $lastRequestTime = $session->get('last_chagoo_request');
            $currentTime = time();

            if ($lastRequestTime && ($currentTime - $lastRequestTime) < 5) {
                return $this->response->setJSON([
                    'reply' => 'Mohon tunggu sekitar 5 detik sebelum mengirim pertanyaan berikutnya.',
                    'csrf_token' => csrf_hash() 
                ]);
            }
            
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

        } catch (\Throwable $e) {
            // JIKA PHP CRASH (Misal cURL tidak ada), ERROR AKAN TAMPIL DI CHAT!
            return $this->response->setJSON([
                'reply' => '🚨 SISTEM PHP CRASH: ' . $e->getMessage() . ' (Baris: ' . $e->getLine() . '). Pastikan ekstensi cURL aktif di php.ini!',
                'csrf_token' => csrf_hash() 
            ]);
        }
    }

    private function generateReplyGroq($msg)
    {
        $apiKey = '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'; 
        
        $url = 'https://api.groq.com/openai/v1/chat/completions';

        $systemInstruction = "Anda adalah ChaGoo Bot, asisten ahli medis profesional yang SECARA EKSKLUSIF memberikan edukasi tentang Demam Berdarah Dengue (DBD). "
            . "TUGAS UTAMA: Anda HANYA boleh menjawab pertanyaan yang berkaitan dengan DBD (definisi, etiologi, patofisiologi, manifestasi klinis, pemeriksaan lab, pengobatan, pencegahan 3M Plus, dsb). "
            . "ATURAN MUTLAK: Jika pengguna bertanya tentang topik di luar DBD (penyakit lain, resep masakan, cuaca, coding, dll), Anda WAJIB MENOLAK dengan sopan dan mengingatkan bahwa Anda hanya melayani pertanyaan seputar DBD. "
            . "ATURAN FORMAT: DILARANG KERAS menggunakan tanda bintang di dalam jawaban untuk alasan apapun. Jawaban Anda HARUS singkat, padat, dan terdiri dari MAKSIMAL 1 PARAGRAF saja.";

        $data = [
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

        $maxRetries = 2; 
        $retryDelay = 2; 

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
            $curlError = curl_error($ch);
            curl_close($ch);

            if ($httpCode == 200) {
                $responseData = json_decode($response, true);
                if (isset($responseData['choices'][0]['message']['content'])) {
                    $finalReply = trim($responseData['choices'][0]['message']['content']);
                    $finalReply = str_replace(chr(42), '', $finalReply); // Hapus bintang tanpa memicu format
                    return $finalReply;
                }
            }

            if ($httpCode == 503 || $httpCode == 429) {
                if ($i < $maxRetries - 1) {
                    sleep($retryDelay); 
                    continue; 
                } else {
                    if ($httpCode == 429) {
                        return "Mohon tunggu sebentar. Anda mengirim pertanyaan terlalu cepat.";
                    } else {
                        return "Maaf, server AI sedang sibuk. Silakan coba tanyakan kembali.";
                    }
                }
            }

            return "🚨 GROQ API ERROR (Kode HTTP: $httpCode). Error cURL: " . ($curlError ? $curlError : 'Kosong') . " | Respons asli: " . $response;
        }

        return "Maaf, ChaGoo tidak dapat memproses jawaban saat ini.";
    }
}