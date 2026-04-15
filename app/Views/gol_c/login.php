<?= $this->include('layout/header') ?>

<section class="container mt-5" style="max-width:500px">

<div class="card p-4 shadow">

<h4 class="text-center mb-4">Login SIGAP</h4>

<form>

<div class="mb-3">
<label>Email</label>
<input type="email" class="form-control" placeholder="Masukkan email">
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" class="form-control" placeholder="Masukkan password">
</div>

<button class="btn btn-teal w-100">Login</button>

</form>

</div>

</section>

<?= $this->include('layout/footer') ?>