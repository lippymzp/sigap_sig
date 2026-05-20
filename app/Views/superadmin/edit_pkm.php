<?= $this->extend('layout/dashboard_superadmin') ?>
<?= $this->section('content') ?>
<style>
/* HEADER USER (SAMA PERSIS) */
.header-user {
    display: flex;
    align-items: center;
    gap: 15px;
    background: linear-gradient(90deg, #081F5C, #5E9ADF);
    color: white;
    padding: 15px 20px;
    border-radius: 10px;
}

.header-icon img {
    width: 40px;
}

/* FORM CONTAINER */
.form-container {
    background: #f8fafc;
    padding: 30px;
    border-radius: 10px;
    margin-top: 20px;
}

/* GRID FORM */
.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

/* INPUT */
.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    margin-bottom: 5px;
    font-size: 14px;
    color: #555;
}

.form-group input,
.form-group select {
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ddd;
    outline: none;
    margin-bottom: 15px;
}

/* BUTTON */
.form-action {
    margin-top: 25px;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.btn-back {
    background: #ccc;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    cursor: pointer;
}

.btn-save {
    background: #081F5C;
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    cursor: pointer;
}

.btn-back:hover {
    background-color: #999;
}

.btn-save:hover {
    background-color: #061944;
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- HEADER -->
<div class="header-user">
    <div class="header-icon">
        <img src="/assets/img/icon_breadcrumb.svg">
    </div>
    <div>
        <h5>Manajemen User</h5>
        <small>Edit User</small>
    </div>
</div>

<!-- FORM -->
<div class="form-container">

    <form action="/superadmin-user/update/<?= $user['id_user'] ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-grid">

            <!-- ROLE -->
            <div class="form-group">
                <label>Role Akses</label>
                <select name="role" required>
                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="kepalapuskesmas" <?= $user['role'] == 'kepalapuskesmas' ? 'selected' : '' ?>>Kepala Puskesmas</option>
                    <option value="kepaladinkes" <?= $user['role'] == 'kepaladinkes' ? 'selected' : '' ?>>Kepala Dinkes</option>
                </select>
            </div>

<div class="form-group">
    <label>Puskesmas</label>

    <select name="puskesmas" required>
        <option value="">-- Pilih Puskesmas --</option>

        <option value="mangli">Puskesmas Mangli</option>

        <option value="kaliwates">Puskesmas Kaliwates</option>

        <option value="jemberkidul">Puskesmas Jember Kidul</option>
    </select>
</div>

            <!-- USERNAME -->
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="<?= esc($user['username']) ?>" placeholder="Masukan Username" required>
            </div>

            <!-- EMAIL -->
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= esc($user['email']) ?>" placeholder="Masukan Email" required>
            </div>

            <!-- PASSWORD (Opsional) -->
            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" value="<?= esc($user['password']) ?>" placeholder="Masukan Password" required>
            </div>

        </div>

        <!-- BUTTON -->
        <div class="form-action">
            <a href="/superadmin-user">
                <button type="button" class="btn-back">Kembali</button>
            </a>
            <button type="submit" class="btn-save">Simpan</button>
        </div>

    </form>

</div>

<?= $this->endSection() ?>