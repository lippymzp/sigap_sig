<?php

namespace App\Controllers;

class AI extends BaseController
{

    public function chat()
    {

        $message = $this->request->getPost('message');

        /*
        =====================================
        API KEY OPENROUTER
        =====================================
        */

        $apiKey = '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';

        /*
        =====================================
        DATA
        =====================================
        */

        $data = [

            "model" => "openai/gpt-3.5-turbo",

            "messages" => [

                [
                    "role" => "system",
                    "content" => "
                    Kamu adalah SIGAP AI,
                    asisten kesehatan tentang diare.

                    Jawab:
                    - bahasa indonesia
                    - khusus penyakit
                    - singkat
                    - jelas
                    - ramah
                    "
                ],

                [
                    "role" => "user",
                    "content" => $message
                ]

            ]

        ];

        /*
        =====================================
        CURL
        =====================================
        */

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://openrouter.ai/api/v1/chat/completions');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        curl_setopt($ch, CURLOPT_HTTPHEADER, [

            'Content-Type: application/json',

            'Authorization: Bearer ' . $apiKey

        ]);

        $result = curl_exec($ch);

        /*
        =====================================
        ERROR CURL
        =====================================
        */

        if(curl_errno($ch)){

            return $this->response->setJSON([
                'answer' => curl_error($ch)
            ]);

        }

        curl_close($ch);

        /*
        =====================================
        JSON
        =====================================
        */

        $response = json_decode($result, true);

        /*
        =====================================
        AMBIL JAWABAN
        =====================================
        */

        if(isset($response['choices'][0]['message']['content'])){

            $answer = $response['choices'][0]['message']['content'];

        }else{

            $answer = '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';

        }

        /*
        =====================================
        RETURN
        =====================================
        */

        return $this->response->setJSON([

            'answer' => nl2br($answer)

        ]);

    }

}