<?= $this->include('layout/header') ?>

<section style="background:linear-gradient(135deg,#20c997,#0dcaf0); padding:60px 0;">

<div class="container">

<div class="card p-4 shadow-lg" style="border-radius:20px; max-width:900px; margin:auto;">

<h4 class="fw-bold mb-3">Apa itu Diare?</h4>

<p>
Diare adalah kondisi buang air besar dengan frekuensi lebih dari tiga kali sehari
dengan konsistensi tinja yang cair. Kondisi ini umumnya disebabkan oleh infeksi
bakteri, virus, atau parasit dari makanan dan minuman yang terkontaminasi.
</p>

<div class="text-center my-4">
<img src="<?= base_url('img/diare.png') ?>" class="img-fluid" style="max-height:250px;">
</div>

<p>
Diare dapat menyebabkan kehilangan cairan dalam tubuh (dehidrasi) yang berbahaya,
terutama pada anak-anak dan lansia. Oleh karena itu, penting untuk segera
menangani diare dengan tepat.
</p>

<hr>

<h5>🔺 Penyebab Diare</h5>
<ul>
<li>Infeksi bakteri (E. coli, Salmonella)</li>
<li>Infeksi virus (Rotavirus)</li>
<li>Parasit dari makanan tidak higienis</li>
<li>Keracunan makanan</li>
<li>Intoleransi makanan (laktosa)</li>
</ul>

<h5>⚠️ Faktor Risiko</h5>
<ul>
<li>Kebersihan makanan buruk</li>
<li>Air minum tidak bersih</li>
<li>Sistem imun lemah</li>
<li>Lingkungan sanitasi rendah</li>
</ul>

<h5>🤒 Gejala Diare</h5>
<ul>
<li>Buang air besar cair terus-menerus</li>
<li>Sakit perut / kram</li>
<li>Mual dan muntah</li>
<li>Demam</li>
<li>Tubuh lemas</li>
</ul>

<h5>🏥 Kapan Harus ke Dokter?</h5>
<ul>
<li>Diare lebih dari 3 hari</li>
<li>Dehidrasi (haus berlebihan, lemas)</li>
<li>Tinja berdarah</li>
<li>Demam tinggi</li>
</ul>

<h5>💊 Pengobatan</h5>
<ul>
<li>Minum oralit / cairan elektrolit</li>
<li>Istirahat cukup</li>
<li>Obat sesuai anjuran dokter</li>
</ul>

<h5>🛡️ Pencegahan</h5>
<ul>
<li>Cuci tangan sebelum makan</li>
<li>Konsumsi air matang</li>
<li>Jaga kebersihan makanan</li>
<li>Hindari makanan tidak higienis</li>
</ul>

<div class="text-end mt-4">
<a href="<?= base_url('diare') ?>" class="btn btn-teal px-4">
    Kembali
</a>
</div>

</div>

</div>
</section>

<?= $this->include('layout/footer') ?>