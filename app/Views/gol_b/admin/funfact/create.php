<?= $this->extend('layout/dashboard_layout') ?>
<?= $this->section('content') ?>

<style>
.tab-box{
    display:flex;
    justify-content:center;
    gap:14px;
    margin-bottom:22px;
}
.tab-btn{
    width:240px;
    height:38px;
    border-radius:8px;
    border:1px solid #d8d8d8;
    background:#fff;
    font-size:14px;
    font-weight:600;
}
.tab-active{
    background:#19bfd1;
    color:#fff;
    border:none;
}
.form-wrap{
    background:#edf7f7;
    padding:30px;
    border-radius:18px;
}
.form-head{
    padding-bottom:16px;
    margin-bottom:24px;
    border-bottom:1px solid #d9e3e3;
}
.form-head h4{
    margin:0;
    font-weight:700;
}
.form-head small{
    color:#777;
}
.form-control{
    border-radius:10px;
    border:1px solid #18bfd1;
    margin-bottom:18px;
}
.toolbar{
    background:#11c5d8;
    color:#fff;
    padding:8px 15px;
    border-radius:10px 10px 0 0;
}
.editor-box{
    width:100%;
    min-height:180px;
    max-height:300px;
    overflow-y:auto;
    border:1px solid #18bfd1;
    border-top:none;
    border-radius:0 0 10px 10px;
    padding:14px;
    background:#fff;
}
.side-card{
    background:#fff;
    border-radius:12px;
    padding:15px;
    margin-bottom:20px;
}
.upload-box{
    border:2px dashed #bbb;
    padding:35px;
    border-radius:10px;
    text-align:center;
}
.bottom-btn{
    margin-top:20px;
    display:flex;
    gap:12px;
    flex-wrap:wrap;
}
.btn-main{
    background:#11c5d8;
    color:#fff;
    border:none;
    padding:12px 22px;
    border-radius:10px;
    font-weight:600;
}
.btn-cancel{
    background:#fff;
    border:none;
    padding:12px 22px;
    border-radius:10px;
}

</style>

<!-- TAB -->
<div class="tab-box">
    <button type="button" class="tab-btn tab-active">
        Tulis Funfact
    </button>

</div>

<!-- FORM TULIS -->
<div id="formTulis">

<form id="formFunfact"
      action="<?= base_url('tbc/funfact/simpan') ?>"
      method="post"
      enctype="multipart/form-data">

<div class="form-wrap">

<div class="row">

<!-- KIRI -->
<div class="col-md-8">

<div class="form-head">
<h4>Detail Informasi Funfact</h4>
<small>Lengkapi data Funfact SIG untuk dipublikasikan.</small>
</div>

<label class="fw-bold">Judul Funfact</label>
<input type="text" name="judul" class="form-control"
placeholder="Masukkan judul funfact utama...">

<label class="fw-bold">Isi Funfact</label>

<div class="toolbar">

<button type="button" onclick="format('bold')"><b>B</b></button>

<button type="button" onclick="format('italic')"><i>I</i></button>

<button type="button" onclick="format('underline')"><u>U</u></button>

<span class="line"></span>

<button type="button" onclick="format('insertUnorderedList')">☰</button>

<button type="button" onclick="format('insertOrderedList')">1.</button>

<button type="button" onclick="buatLink()">🔗</button>

<button type="button" onclick="insertImage()">🖼</button>

</div>

<div id="editor"
     class="editor-box"
     contenteditable="true"
     style="background:#fff;"></div>

<input type="hidden" name="isi" id="isiHidden">

<label class="fw-bold">Ringkasan / Deskripsi Singkat</label>
<input type="text" name="ringkasan"
class="form-control"
placeholder="Masukkan ringkasan singkat...">

<div class="row">

<div class="col-md-6">
<label class="fw-bold">Penulis</label>
<input type="text" name="penulis"
class="form-control"
placeholder="Nama penulis">
</div>

<div class="col-md-6">
<label class="fw-bold">Tanggal Unggah</label>
<input type="date" name="tanggal"
class="form-control">
</div>

</div>

<div class="bottom-btn">

<button type="button"
        class="btn-cancel"
        onclick="window.location.href='<?= base_url('tbc/funfact') ?>'">
Batal
</button>

<button type="button"
class="btn-main"
onclick="simpanDraft()">
<<<<<<< Updated upstream
💾 Simpan Drive
=======
💾 Simpan Draft
>>>>>>> Stashed changes
</button>

<button type="button"
class="btn-main"
onclick="validasiForm()">
⬆ Unggah
</button>

</div>

</div>

<!-- KANAN -->
<div class="col-md-4">

<!-- CARD PREVIEW -->
<div class="side-card">

<div id="previewThumb" style="
height:180px;
border-radius:12px;
background:#f5f5f5;
display:flex;
align-items:center;
justify-content:center;
color:#aaa;
font-size:14px;
overflow:hidden;
">
Belum ada gambar
</div>

<p class="mt-3 fw-bold small mb-1">
Preview Thumbnail
</p>

<small class="text-muted">
Akan tampil setelah upload gambar
</small>

</div>

<!-- CARD UPLOAD -->
<div class="side-card text-center">

UNGGAH THUMBNAIL
</h6>

<label class="upload-box"
for="gambarInput"
style="cursor:pointer;">

<div id="previewArea">
📤 <br><br>
Klik Untuk Unggah
</div>

</label>

<input type="file"
name="gambar"
id="gambarInput"
accept="image/*"
style="display:none;">

</div>

</div>

</div>
</div>
</form>
</div>

<<<<<<< Updated upstream
<!-- FORM KUTIP -->
<div id="formKutipFunfact" style="display:none;">

<form id="formKutipFunfact"
      action="<?= base_url('tbc/funfact/kutip') ?>"
      method="post">

<div class="form-wrap">

<div class="form-head">
<h4>Detail Informasi Funfact</h4>
<small>Lengkapi data Funfact SIG untuk dipublikasikan.</small>
</div>

<label class="fw-bold">Judul Funfact</label>
<input type="text"
       name="judul"
       class="form-control"
       placeholder="Masukkan judul funfact utama...">

<label class="fw-bold">Link Funfact</label>
<input type="text"
       name="link"
       class="form-control"
       placeholder="https://...">

<input type="hidden" name="status" id="statusKutip">

<div class="bottom-btn">

<button type="button"
        class="btn-cancel"
        onclick="batalForm()">
Batal
</button>

<button type="button"
        class="btn-main"
        onclick="simpanDraftKutip()">
<<<<<<< Updated upstream
💾 Simpan Drive
=======
💾 Simpan Draft
>>>>>>> Stashed changes
</button>

<button type="button"
        class="btn-main"
        onclick="unggahKutip()">
⬆ Unggah
</button>

</div>

</div>
</form>
</div>

=======
>>>>>>> Stashed changes
<!-- POPUP -->
<div id="popupBg" style="
display:none;
position:fixed;
top:0;left:0;
width:100%;height:100%;
background:rgba(0,0,0,.35);
z-index:9999;">

<div style="
width:290px;
background:#fff;
padding:24px;
border-radius:12px;
text-align:center;
position:absolute;
top:50%;
left:50%;
transform:translate(-50%,-50%);">

<h5 id="popupTitle">Unggah Funfact Gagal</h5>
<p id="popupText">Mohon lengkapi semua kolom</p>

<div id="popupButtons"></div>

</div>
</div>

<script>

function validasiForm(){

document.getElementById('isiHidden').value =
document.getElementById('editor').innerHTML.trim();

let judul = document.querySelector('[name=judul]').value.trim();
let isi = document.getElementById('isiHidden').value.trim();
let ringkasan = document.querySelector('[name=ringkasan]').value.trim();
let penulis = document.querySelector('[name=penulis]').value.trim();
let tanggal = document.querySelector('[name=tanggal]').value.trim();

if(judul=='' || isi=='' || ringkasan=='' || penulis=='' || tanggal==''){

document.getElementById('popupBg').style.display='block';
document.getElementById('popupTitle').innerHTML='Unggah Funfact Gagal';
document.getElementById('popupText').innerHTML='Mohon lengkapi semua kolom';

document.getElementById('popupButtons').innerHTML=`
<button onclick="closePopup()" class="btn-main">
Lengkapi Data
</button>`;

return;
}

document.getElementById('formFunfact').submit();
}

function simpanDraft(){

let judul = document.querySelector('[name=judul]').value.trim();
let isi = document.getElementById('editor').innerHTML.trim();

if(judul=='' || isi==''){

document.getElementById('popupBg').style.display='block';

document.getElementById('popupTitle').innerHTML='Draft Gagal';
document.getElementById('popupText').innerHTML='Minimal isi Judul dan Isi Funfact';

document.getElementById('popupButtons').innerHTML=`
<button onclick="closePopup()" class="btn-main">
Lengkapi Data
</button>`;

return;
}

// penting: isi ke hidden input
document.getElementById('isiHidden').value = isi;

let form = document.getElementById('formFunfact');

let lama = document.querySelector('[name=status]');
if(lama) lama.remove();

let input = document.createElement('input');
input.type='hidden';
input.name='status';
input.value='Draft';

form.appendChild(input);
form.submit();
}

function closePopup(){
document.getElementById('popupBg').style.display='none';
}



/* PREVIEW GAMBAR */
document.getElementById('gambarInput').onchange = function(e){

let file = e.target.files[0];
if(!file) return;

let reader = new FileReader();

reader.onload = function(ev){

document.getElementById('previewThumb').innerHTML =
`<img src="${ev.target.result}"
style="width:100%;height:100%;object-fit:cover;">`;

document.getElementById('previewArea').innerHTML = `
<img src="${ev.target.result}"
style="width:100%;height:160px;object-fit:cover;border-radius:12px;">
`;

}

reader.readAsDataURL(file);
};



/* RESET GAMBAR */

function resetSemua(){

document.getElementById('formFunfact').reset();

document.getElementById('gambarInput').value='';

document.getElementById('previewThumb').innerHTML = 'Belum ada gambar';

document.getElementById('previewArea').innerHTML = `
📤 <br><br>
Klik Untuk Unggah
`;

}

window.onload = resetSemua;

window.onpageshow = function(event){
resetSemua();
}

function format(cmd){
document.execCommand(cmd,false,null);
}

function buatLink(){
let url = prompt("Masukkan link:");
if(url){
document.execCommand("createLink",false,url);
}
}

function insertImage(){
let url = prompt("Masukkan URL gambar:");
if(url){
document.execCommand("insertImage",false,url);
}
}

/* Saat submit simpan isi editor ke input hidden */
document.getElementById('formFunfact').onsubmit = function(){
document.getElementById('isiHidden').value =
document.getElementById('editor').innerHTML;
}
</script>
<script>
function batalForm(){
window.location.href='<?= base_url('tbc/funfact') ?>';
}

<?= $this->endSection() ?>