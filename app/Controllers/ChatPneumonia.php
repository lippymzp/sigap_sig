<?php

namespace App\Controllers;

class ChatPneumonia extends BaseController
{
    public function index()
    {
        return view('gol_c/chatbot/chat_pneumonia');
    }

    public function send()
    {
        $message = strtolower(trim($this->request->getPost('message')));

        if (empty($message)) {
            return $this->response->setJSON([
                'reply' => 'Silakan masukkan pertanyaan terlebih dahulu.'
            ]);
        }

        $reply = $this->generateReply($message);

        return $this->response->setJSON([
            'reply' => $reply
        ]);
    }

    private function generateReply($msg)
    {

        // ==================================================
        // GEJALA BERAT / DARURAT
        // ==================================================

        if (
            str_contains($msg, 'sesak berat') ||
            str_contains($msg, 'napas cepat') ||
            str_contains($msg, 'bibir biru') ||
            str_contains($msg, 'kejang') ||
            str_contains($msg, 'tidak sadar') ||
            str_contains($msg, 'sulit bernapas') ||
            str_contains($msg, 'kesulitan bernapas') ||
            str_contains($msg, 'susah napas') ||
            str_contains($msg, 'sulit bernafas')||
            str_contains($msg, 'susah nafas')||
            str_contains($msg, 'Kesusahan bernapas')

        ) {

            return "
⚠️ Gejala yang Anda sebutkan memerlukan perhatian medis segera.
Segera periksa ke fasilitas pelayanan kesehatan (Puskesmas, Klinik, atau Rumah Sakit) terdekat terutama bila terdapat:
• Sesak napas berat
• Napas sangat cepat
• Bibir/kuku kebiruan
• Penurunan kesadaran
• Kejang
• Anak tampak lemas atau sulit minum

Pemeriksaan langsung oleh tenaga kesehatan diperlukan untuk mengetahui kondisi sebenarnya.";
        }
        if (
    str_contains($msg, 'halo') ||
    str_contains($msg, 'hai') ||
    str_contains($msg, 'hi') ||
    str_contains($msg, 'oi') ||
    str_contains($msg, 'apa kabar') 
) { 

    return "Halo 👋 Ada yang bisa saya bantu mengenai pneumonia?";
}
if (
    $msg == 'iya' ||
    $msg == 'oke' ||
    $msg == 'yaudah' ||
    $msg == 'ya'
) {

    return "Baik 😊 Silakan lanjutkan pertanyaannya.";
}
if (
    $msg == 'tidak' ||
    $msg == 'gak' ||
    $msg == 'nggak'
) {

    return "Baik 😊 Jika ada pertanyaan lain silakan tanyakan.";
}


        // ==================================================
        // PNEUMONIA
        // ==================================================

        if (str_contains($msg, 'pneumonia')) {

            return "
Pneumonia adalah infeksi pada paru-paru yang dapat disebabkan oleh bakteri, virus, atau jamur.

Upaya promotif dan preventif yang dapat dilakukan:

• Menjaga daya tahan tubuh dengan makan bergizi
• Istirahat cukup setiap hari
• Minum air putih yang cukup
• Rutin mencuci tangan menggunakan sabun
• Menggunakan masker saat sakit atau di tempat ramai
• Menghindari asap rokok dan polusi udara
• Menjaga ventilasi rumah agar sirkulasi udara baik
• Melakukan imunisasi sesuai anjuran
• Rutin aktivitas fisik ringan
• Menjaga kebersihan lingkungan rumah

Segera periksa ke fasilitas kesehatan bila muncul:
• Demam tinggi
• Batuk tidak membaik
• Sesak napas
• Nyeri dada
• Napas cepat
";
        }

        

        // ==================================================
        // BATUK
        // ==================================================

        if (str_contains($msg, 'batuk')) {

            return "
Batuk dapat menjadi mekanisme alami tubuh untuk membersihkan saluran napas.

Hal yang dapat dilakukan:

• Perbanyak minum air hangat
• Istirahat cukup
• Gunakan masker agar tidak menularkan penyakit
• Hindari asap rokok
• Konsumsi makanan bergizi
• Jaga kelembapan ruangan
• Cuci tangan secara rutin

Segera periksa ke fasilitas kesehatan bila:
• Batuk lebih dari 2 minggu
• Disertai sesak napas
• Demam tinggi
• Nyeri dada
• Dahak berdarah
";
        }

        // ==================================================
        // SESAK NAPAS
        // ==================================================

        if (
            str_contains($msg, 'sesak') ||
            str_contains($msg, 'sulit napas')
        ) {

            return "
Sesak napas dapat dipengaruhi berbagai kondisi sehingga perlu diperhatikan dengan serius.

Langkah yang dapat dilakukan:
• Istirahat
• Duduk dengan posisi nyaman
• Hindari aktivitas berat
• Hindari asap rokok dan polusi
• Pastikan sirkulasi udara baik

Segera periksa ke fasilitas kesehatan bila:
• Sesak memberat
• Napas cepat
• Bibir kebiruan
• Nyeri dada
• Sulit berbicara karena sesak
";
        }

        // ==================================================
        // DEMAM
        // ==================================================

        if (str_contains($msg, 'demam')) {

            return "
Demam merupakan respons tubuh terhadap infeksi atau peradangan.

Yang dapat dilakukan:
• Perbanyak cairan
• Istirahat cukup
• Gunakan pakaian nyaman
• Konsumsi makanan bergizi
• Pantau suhu tubuh

Segera periksa ke fasilitas kesehatan bila:
• Demam tinggi tidak turun
• Disertai sesak napas
• Kejang
• Lemas berat
• Penurunan kesadaran
";
        }

        // ==================================================
        // ANAK
        // ==================================================

        if (
            str_contains($msg, 'anak') ||
            str_contains($msg, 'bayi')
        ) {

            return "
Anak dan bayi lebih rentan mengalami infeksi saluran pernapasan termasuk pneumonia.

Pencegahan yang dapat dilakukan:
• Berikan ASI eksklusif
• Lengkapi imunisasi
• Hindari paparan asap rokok
• Pastikan rumah memiliki ventilasi baik
• Jaga kebersihan tangan dan lingkungan
• Berikan makanan bergizi sesuai usia

Segera periksa ke fasilitas kesehatan bila anak:
• Napas cepat
• Sesak napas
• Sulit minum
• Demam tinggi
• Tampak sangat lemas
";
        }

        // ==================================================
        // VAKSIN
        // ==================================================

        if (
            str_contains($msg, 'vaksin') ||
            str_contains($msg, 'imunisasi')
        ) {

            return "
Imunisasi dapat membantu menurunkan risiko infeksi tertentu yang dapat menyebabkan pneumonia.

Beberapa imunisasi yang penting sesuai anjuran tenaga kesehatan:
• Imunisasi PCV
• Imunisasi DPT
• Imunisasi campak
• Imunisasi influenza
• Imunisasi COVID-19 sesuai ketentuan

Selain imunisasi:
• Terapkan PHBS
• Hindari asap rokok
• Konsumsi makanan bergizi
• Istirahat cukup
";
        }

        // ==================================================
        // ASAP ROKOK
        // ==================================================

        if (
            str_contains($msg, 'rokok') ||
            str_contains($msg, 'asap')
        ) {

            return "
Asap rokok dapat merusak saluran pernapasan dan meningkatkan risiko infeksi paru termasuk pneumonia.

Pencegahan:
• Hindari merokok di dalam rumah
• Jauhkan anak dari paparan asap rokok
• Pastikan ventilasi rumah baik
• Terapkan kawasan bebas asap rokok

Paparan asap rokok terus-menerus dapat meningkatkan risiko gangguan paru pada anak maupun dewasa.
";
        }

        // ==================================================
        // POLUSI
        // ==================================================

        if (
            str_contains($msg, 'polusi') ||
            str_contains($msg, 'udara')
        ) {

            return "
Polusi udara dapat mengganggu kesehatan paru dan meningkatkan risiko infeksi saluran pernapasan.

Yang dapat dilakukan:
• Gunakan masker saat kualitas udara buruk
• Kurangi aktivitas luar ruangan saat polusi tinggi
• Menanam tanaman penghijauan
• Pastikan ventilasi rumah baik
• Hindari pembakaran sampah
";
        }
if (
    str_contains($msg, 'tentang cybot') ||
    str_contains($msg, 'apa itu cybot') ||
    str_contains($msg, 'siapa cybot')
) {

    return " Saya adalah Cybot, chatbot edukasi kesehatan yang dirancang untuk membantu memberikan informasi mengenai pneumonia dan kesehatan pernapasan.
CYBOT dapat membantu memberikan edukasi mengenai:
• Pneumonia
• Gejala umum
• Batuk
• Demam
• Sesak napas
• Vaksinasi
• Pencegahan penyakit paru

⚠️ Informasi yang diberikan bersifat edukatif dan tidak menggantikan pemeriksaan langsung oleh tenaga kesehatan.
";
}

if (
    str_contains($msg, 'pencegahan') ||
    str_contains($msg, 'menjaga kesehatan paru') ||
    str_contains($msg, 'mencegah') ||
    str_contains($msg, 'kesehatan paru')
) {

    return "Menjaga kesehatan paru sangat penting untuk membantu sistem pernapasan bekerja dengan baik.

Beberapa langkah pencegahan penyakit paru yang dapat dilakukan:
• Hindari asap rokok dan vape
• Gunakan masker saat berada di lingkungan berpolusi
• Rutin olahraga ringan
• Konsumsi makanan bergizi
• Minum air putih yang cukup
• Jaga ventilasi rumah agar sirkulasi udara baik
• Hindari paparan debu dan asap pembakaran
• Cuci tangan secara rutin
• Lakukan vaksinasi sesuai anjuran tenaga kesehatan

Segera periksa ke fasilitas kesehatan bila mengalami:
• Batuk berkepanjangan
• Sesak napas
• Nyeri dada
• Napas berbunyi
• Mudah lelah saat bernapas
";
}

if (
    str_contains($msg, 'terima kasih') ||
    str_contains($msg, 'thanks') ||
    str_contains($msg, 'thank you') ||
    str_contains($msg, 'makasih')
) {

    return "Sama-sama 😊 Semoga sehat selalu.
    Jika ada pertanyaan silahkan tanyakan saja";
}
        // ==================================================
        // DEFAULT
        // ==================================================

        return 
"Mohon maaf, saya tidak mengerti apa yang anda katakan
Saya hanya dapat membantu memberikan informasi mengenai:
• Pencegahan pneumonia
• Gejala umum
• Vaksinasi
• Batuk
• Demam
• Sesak napas
• Kesehatan paru
• Pencegahan infeksi saluran napas

Silakan tanyakan hal terkait pneumonia atau kesehatan pernapasan ya😊
";
    }
}