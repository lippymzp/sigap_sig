<?= $this->include('layout/header') ?>

<section class="container mt-5">

<h3 class="text-teal mb-4 text-center">Skrining Kesehatan Diare</h3>

<div class="card p-4 shadow" style="border-radius:20px; max-width:700px; margin:auto;">

<form id="formDiare">

<div class="mb-3">
<label>1. Apakah Anda mengalami diare lebih dari 3x sehari?</label>
<select class="form-control" name="q1">
<option value="0">Tidak</option>
<option value="1">Ya</option>
</select>
</div>

<div class="mb-3">
<label>2. Apakah terdapat darah/lendir pada feses?</label>
<select class="form-control" name="q2">
<option value="0">Tidak</option>
<option value="1">Ya</option>
</select>
</div>

<div class="mb-3">
<label>3. Apakah Anda mengalami mual atau muntah?</label>
<select class="form-control" name="q3">
<option value="0">Tidak</option>
<option value="1">Ya</option>
</select>
</div>

<div class="mb-3">
<label>4. Apakah tubuh terasa lemas/dehidrasi?</label>
<select class="form-control" name="q4">
<option value="0">Tidak</option>
<option value="1">Ya</option>
</select>
</div>

<div class="mb-3">
<label>5. Apakah Anda mengalami demam?</label>
<select class="form-control" name="q5">
<option value="0">Tidak</option>
<option value="1">Ya</option>
</select>
</div>

<div class="text-center mt-4">
<button type="button" class="btn btn-teal" onclick="hitungDiare()">
    Lihat Hasil
</button>
</div>

</form>

<div id="hasilDiare" class="mt-4 text-center"></div>

</div>

</section>

<script>
function hitungDiare(){

let form = document.getElementById('formDiare');
let data = new FormData(form);

let total = 0;

for (let val of data.values()) {
    total += parseInt(val);
}

let hasil = "";

if(total <= 1){
    hasil = "<span class='text-success'>Risiko Rendah</span>";
}
else if(total <= 3){
    hasil = "<span class='text-warning'>Risiko Sedang</span>";
}
else{
    hasil = "<span class='text-danger'>Risiko Tinggi</span>";
}

document.getElementById('hasilDiare').innerHTML = `
    <h5>Hasil Skrining:</h5>
    <h3>${hasil}</h3>
`;
}
</script>

<?= $this->include('layout/footer') ?>