<?php $this->setVar('penyakit', 'tbc'); ?>
<?= $this->include('layout/header') ?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style> 
     body {
        background: var(--bg);
        font-family: 'Poppins', sans-serif !important;

    }
</style>


<section style="background:linear-gradient(135deg,#20c997,#0dcaf0); padding:60px 0;">

    <div class="container">

        <div class="card p-4 shadow-lg" style="border-radius:20px; max-width:900px; margin:auto;">

            <h4 class="fw-bold mb-3">Apa Itu Tuberkulosis?</h4>

            <p>
                Tuberkulosis atau TB adalah penyakit yang disebabkan oleh infeksi
                bakteri Mycobacterium tuberculosis. Bakteri tersebut dapat masuk ke
                dalam paru-paru dan mengakibatkan pengidapnya mengalami sesak napas
                disertai batuk kronis. Kebanyakan dari kita hanya mengetahui bahwa 
                penyakit ini menyerang organ paru-paru. Namun faktanya, kuman TBC juga 
                bisa menyerang bagian tubuh lainnya seperti kulit, tulang dan kelenjar getah bening.
            </p>

            <div class="text-center my-4">
                <img src="<?= base_url('img/tbc_detail.png') ?>" class="img-fluid" style="max-height:250px;">
            </div>

            <p>
                Walaupun TBC mudah menular dan menyebabkan kematian, namun penyakit ini  dapat disembuhkan dengan meminum obat secara teratur sampai benar-benar  dinyatakan sembuh oleh dokter sehingga bisa memutus rantai penularan TBC. Jika tidak teratur minum obat, penderita TBC akan sulit sembuh, masih bisa menularkan penyakit dan bisa menjadi resisten terhadap obat. Untuk terhindar dari TBC, kita dianjurkan untuk menerapkan perilaku  hidup bersih dan sehat serta mengaplikasikan etika batuk yang benar.  Untuk penanganan penderita positif TBC, pemerintah memberikan obat  secara gratis yang bisa didapat di Puskesmas terdekat.
            </p>

            <hr>

            <h5>🫁 Penyebab Tuberkulosis</h5>
            <ul>
                <li>Bakteri Mycobacterium tuberculosis yang menyerang terutama paru-paru.</li>
                <li>Penularan TBC terjadi melalui udara (droplet) saat penderita batuk, bersin, berbicara, atau meludah.</li>
                <li>Tempat-tempat dengan kondisi lingkungan yang tidak sehat, seperti ventilasi yang buruk.</li>
            </ul>

            <h5>⚠️ Faktor Risiko</h5>
            <ul>
                <li>Sistem kekebalan tubuh yang lemah akibat penyakit tertentu atau penggunaan obat-obatan tertentu.</li>
                <li>Lansia yang mengalami penurunan daya tahan tubuh seiring bertambahnya usia.</li>
                <li>Individu yang melakukan perjalanan ke wilayah dengan tingkat kasus TBC yang tinggi.</li>
                <li>Kebiasaan merokok, baik sebagai perokok aktif maupun pasif.</li>
                <li>Tinggal bersama penderita tuberkulosis, yang meningkatkan kemungkinan penularan.</li>
            </ul>

            <h5>🤒 Gejala Diare</h5>
            <ul>
                <li>Batuk berdahak selama 2 minggu atau lebih sebagai gejala utama tuberkulosis.</li>
                <li>Dahak dapat bercampur darah atau disertai batuk darah akibat infeksi pada paru-paru.</li>
                <li>Sesak napas yang muncul karena fungsi paru-paru terganggu.</li>
                <li>Badan terasa lemas dan mudah lelah akibat kondisi tubuh menurun.</li>
                <li>Nafsu makan menurun yang dapat menyebabkan berat badan turun serta malaise.</li>
                <li>Berkeringat pada malam hari tanpa aktivitas fisik dan demam lebih dari 1 bulan.</li>
            </ul>

            <h5>🏥 Kapan Harus ke Dokter?</h5>
            <ul>
                <li>Batuk lebih dari 3 minggu, terutama jika disertai darah</li>
                <li>Nyeri dada atau sesak napas</li>
                <li>Demam tinggi yang tidak kunjung turun</li>
                <li>Berat badan terus menurun tanpa alasan jelas</li>
                <li>Pernah kontak erat dengan penderita TBC</li>
            </ul>

            <h5>💊 Pengobatan</h5>
            <ul>
                <li>Obat antituberkulosis (OAT) secara teratur selama 6-9 bulan.</li>
                <li>Pemeriksaan rutin dilakukan untuk memantau perkembangan dan keberhasilan pengobatan.</li>
                <li>Istirahat cukup dan konsumsi makanan bergizi membantu mempercepat pemulihan.</li>
                <li>Menggunakan masker dan menghindari kontak dekat untuk mencegah penularan.</li>
                <li>Menerapkan pola hidup sehat seperti tidak merokok dan menjaga kebersihan diri.</li>
            </ul>

            <h5>🛡️ Pencegahan</h5>
            <ul>
                <li>Imunisasi BCG (Bacille Calmette-Guérin) sebelum bayi berusia 2 bulan</li>
                <li>Menghindari kontak erat dengan penderita TBC dan menggunakan masker</li>
                <li>Menutup mulut saat batuk atau bersin serta menjaga kebersihan tangan</li>
                <li>Menjaga ventilasi rumah dan kebersihan lingkungan</li>
                <li>Menjaga daya tahan tubuh dan rutin memeriksakan kesehatan</li>
            </ul>

            <div class="text-end mt-4">
                <a href="<?= base_url('tbc') ?>" class="btn btn-teal px-4">
                    Kembali
                </a>
            </div>

        </div>

    </div>
</section>

<?= $this->include('layout/footer') ?>