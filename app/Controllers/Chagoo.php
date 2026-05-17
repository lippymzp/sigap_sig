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
        // Standarisasi input menjadi huruf kecil untuk memudahkan pencocokan kata kunci
        $message = strtolower(trim((string) $this->request->getPost('message')));

        if (empty($message)) {
            return $this->response->setJSON([
                'reply' => 'Silakan masukkan pertanyaan terlebih dahulu.',
                'csrf_token' => csrf_hash() // Wajib kirim balik token baru
            ]);
        }

        // Proses balasan
        $reply = $this->generateReply($message);

        return $this->response->setJSON([
            'reply' => $reply,
            'csrf_token' => csrf_hash() // Wajib kirim balik token baru
        ]);
    }

    private function generateReply($msg)
    {
        // ==================================================
        // 0. SAPAAN DASAR
        // ==================================================
        if (strpos($msg, 'halo') !== false || strpos($msg, 'hai') !== false || strpos($msg, 'pagi') !== false || strpos($msg, 'siang') !== false || strpos($msg, 'malam') !== false) {
            return "Halo! Saya adalah ChaGoo Bot, asisten edukasi Demam Berdarah Dengue (DBD).\n\nSilakan tanyakan apa saja terkait DBD, mulai dari definisi, gejala, etiologi, patofisiologi, pemeriksaan, dan pencegahan😊";
        }

        // ==================================================
        // 1. DEFINISI
        // ==================================================
        if (strpos($msg, 'definisi') !== false || strpos($msg, 'apa itu') !== false || strpos($msg, 'pengertian') !== false || strpos($msg, 'dimaksud') !== false || strpos($msg, 'arti') !== false) {
            return "Demam Berdarah Dengue (DBD) atau Dengue Hemorrhagic Fever (DHF) adalah penyakit infeksi akibat virus Dengue yang ditularkan melalui gigitan nyamuk. Penyakit ini merupakan bentuk yang lebih parah dari Demam Dengue (DD), yang ditandai dengan demam tinggi, penurunan trombosit (trombositopenia), dan adanya kebocoran plasma darah yang bisa mengancam jiwa.";
        }

        // ==================================================
        // 2. ETIOLOGI (PENYEBAB)
        // ==================================================
        if (strpos($msg, 'etiologi') !== false || strpos($msg, 'penyebab') !== false || strpos($msg, 'disebabkan') !== false || strpos($msg, 'karena apa') !== false) {
            return "Penyebab utama DBD adalah infeksi virus Dengue (DENV) yang memiliki 4 serotipe, yaitu DENV-1, DENV-2, DENV-3, dan DENV-4. Virus ini masuk ke tubuh manusia melalui gigitan nyamuk betina dari spesies *Aedes aegypti* (vektor utama) dan *Aedes albopictus*.";
        }

        // ==================================================
        // 3. MANIFESTASI KLINIS & GEJALA
        // ==================================================
        if (strpos($msg, 'manifestasi') !== false || strpos($msg, 'gejala') !== false || strpos($msg, 'siklus') !== false || strpos($msg, 'pelana kuda') !== false || strpos($msg, 'tanda') !== false || strpos($msg, 'ciri') !== false) {
            return "Gejala DBD sering disebut memiliki siklus \"Pelana Kuda\" yang terbagi menjadi 3 fase:\n\n• Fase Demam (Hari 1-3): Demam tinggi mendadak (bisa mencapai 40°C), nyeri kepala berat, nyeri di belakang mata, nyeri otot dan sendi, mual, muntah, serta muncul bintik merah (petekie) di kulit.\n• Fase Kritis (Hari 4-5): Demam turun drastis seolah sembuh, namun ini adalah fase paling berbahaya. Terjadi kebocoran plasma darah yang bisa menyebabkan tekanan darah anjlok, nadi lemah, perdarahan (mimisan, gusi berdarah, BAB hitam), hingga syok (Dengue Shock Syndrome/DSS).\n• Fase Pemulihan (Hari 6-7): Demam mungkin kembali naik sedikit, namun cairan tubuh mulai kembali normal, nafsu makan membaik, dan trombosit perlahan naik.";
        }

        // ==================================================
        // 4. PATOFISIOLOGI
        // ==================================================
        if (strpos($msg, 'patofisiologi') !== false || strpos($msg, 'proses') !== false || strpos($msg, 'merusak') !== false || strpos($msg, 'cara kerja virus') !== false) {
            return "Setelah virus Dengue masuk melalui gigitan nyamuk, ia akan mereplikasi diri di dalam kelenjar getah bening dan menyebar melalui darah. Sistem imun tubuh akan merespons, yang memicu pelepasan zat sitokin secara berlebihan. Badai sitokin ini menyebabkan disfungsi endotel (dinding pembuluh darah), sehingga permeabilitas pembuluh kapiler meningkat. Akibatnya, cairan plasma darah bocor keluar dari pembuluh darah ke jaringan sekitarnya, memicu penurunan volume darah, penurunan trombosit, dan risiko syok.";
        }

        // ==================================================
        // 5. PEMERIKSAAN PENUNJANG
        // ==================================================
        if (strpos($msg, 'pemeriksaan') !== false || strpos($msg, 'laboratorium') !== false || strpos($msg, 'lab') !== false || strpos($msg, 'cek') !== false || strpos($msg, 'tes') !== false) {
            return "Pemeriksaan utama meliputi:\n\n• Darah Rutin (Darah Lengkap): Untuk memantau penurunan kadar Trombosit (biasanya <100.000/µL) dan peningkatan Hematokrit (indikasi darah mengental karena kebocoran plasma).\n• Antigen NS1: Efektif dilakukan pada hari ke-1 hingga ke-3 demam untuk mendeteksi keberadaan virus.\n• Antibodi IgG/IgM Dengue: Dilakukan setelah hari ke-4 demam untuk melihat respons sistem imun tubuh terhadap infeksi, sekaligus membedakan infeksi primer (baru pertama kali) atau sekunder (pernah kena sebelumnya).";
        }

        // ==================================================
        // 6. FAKTOR RISIKO LINGKUNGAN
        // ==================================================
        if (strpos($msg, 'risiko') !== false || strpos($msg, 'lingkungan') !== false || strpos($msg, 'rentan') !== false || strpos($msg, 'faktor') !== false) {
            return "Faktor risikonya meliputi curah hujan tinggi (musim penghujan) yang menciptakan banyak genangan air bersih, kelembapan dan suhu udara yang hangat, urbanisasi yang padat, serta sanitasi lingkungan yang buruk di mana banyak barang bekas (ban, kaleng, botol) yang menjadi tempat perindukan (breeding place) nyamuk *Aedes aegypti*.";
        }

        // ==================================================
        // 7. OBAT DAN PENATALAKSANAAN
        // ==================================================
        if (strpos($msg, 'obat') !== false || strpos($msg, 'penatalaksanaan') !== false || strpos($msg, 'terapi') !== false || strpos($msg, 'tindakan') !== false || strpos($msg, 'menyembuhkan') !== false) {
            return "Tidak ada obat spesifik yang dapat membunuh virus Dengue. Penatalaksanaan bersifat suportif dan simtomatik:\n\n• Terapi Cairan: Paling krusial. Pasien harus minum banyak air (air putih, oralit, jus, kuah sup) atau mendapat cairan infus (Ringer Laktat/Asetat) jika dirawat, untuk mengganti cairan plasma yang bocor.\n• 
            Obat Penurun Panas: Hanya gunakan Paracetamol.\n\nPenting: Hindari obat golongan NSAID seperti Ibuprofen, Aspirin, atau Asam Mefenamat karena dapat mengiritasi lambung dan memicu perdarahan hebat.";
        }

        // ==================================================
        // 8. PENCEGAHAN
        // ==================================================
        if (strpos($msg, 'cegah') !== false || strpos($msg, 'pencegahan') !== false || strpos($msg, '3m') !== false || strpos($msg, 'menghindari') !== false) {
            return "Pencegahan paling efektif adalah mengendalikan populasi nyamuk melalui gerakan 3M Plus: Menguras tempat penampungan air, Menutup rapat tempat penampungan air, dan Mendaur ulang barang bekas. \"Plus\" meliputi menaburkan bubuk larvasida (abate) di bak air, menggunakan kelambu atau lotion anti nyamuk, memasang kawat kasa di ventilasi, serta mendapatkan vaksinasi Dengue jika direkomendasikan dokter.";
        }

        // ==================================================
        // 9. KOMORBIDITAS (PENYAKIT PENYERTA)
        // ==================================================
        if (strpos($msg, 'komorbid') !== false || strpos($msg, 'bawaan') !== false || strpos($msg, 'penyerta') !== false) {
            return "Ya, sangat berpengaruh. Pasien DBD yang memiliki komorbid seperti Diabetes Mellitus, Hipertensi, Obesitas, atau penyakit jantung memiliki risiko lebih tinggi untuk mengalami komplikasi berat. Komorbiditas ini membuat pembuluh darah lebih rentan dan mempersulit manajemen pemberian cairan infus, sehingga risiko jatuh ke fase syok (DSS) lebih besar.";
        }

        // ==================================================
        // 10. EPIDEMIOLOGI
        // ==================================================
        if (strpos($msg, 'epidemiologi') !== false || strpos($msg, 'tren') !== false || strpos($msg, 'penyebaran') !== false || strpos($msg, 'kasus' || strpos($msg, 'apa itu epidemiologi')) !== false) {
            return "DBD merupakan penyakit endemis yang banyak ditemukan di wilayah beriklim tropis dan subtropis, termasuk Indonesia. Kasus biasanya melonjak secara siklikal setiap tahun, dengan puncak insiden terjadi selama musim penghujan hingga awal musim kemarau. Semua kelompok umur rentan terkena, namun kasus kematian tertinggi sering tercatat pada anak-anak dan lansia.";
        }

        // ==================================================
        // DEFAULT JIKA KATA KUNCI TIDAK DITEMUKAN
        // ==================================================
        return "Maaf, saya hanya bisa menjawab pertanyaan tentang penyakit seputar Dengue.\n\nSilakan tanyakan hal-hal yang berkaitan dengan DBD, mulai dari definisi, gejala, etiologi, patofisiologi, manifestasi klinik, pemeriksaan, faktor risiko lingkungan, obat, pencegahan, komorbid, hingga epidemiologi.";
    }
}