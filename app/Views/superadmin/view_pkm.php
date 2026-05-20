<?= $this->extend('layout/dashboard_superadmin') ?>
<?= $this->section('content') ?>
<style>
    /* HEADER USER */
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

    /* READONLY STYLE */
    input[readonly],
    select[disabled] {
        background-color: #eee;
        cursor: not-allowed;
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

    .btn-back:hover {
        background-color: #999;
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
        <small>Detail User</small>
    </div>
</div>

<!-- FORM -->
<div class="form-container">

    <div class="form-grid">

        <!-- ROLE -->
        <!-- ROLE -->
        <div class="form-group">
            <label>Role Akses</label>

            <select disabled>
                <option><?= esc($user['role']) ?></option>
            </select>
        </div>

        <!-- PUSKESMAS -->
        <div class="form-group">
            <label>Puskesmas</label>

            <input type="text"
                value="<?= esc($user['puskesmas']) ?>"
                readonly>
        </div>

        <!-- USERNAME -->
        <div class="form-group">
            <label>Username</label>
            <input type="text" value="<?= esc($user['username']) ?>" readonly>
        </div>

        <!-- EMAIL -->
        <div class="form-group">
            <label>Email</label>
            <input type="email" value="<?= esc($user['email']) ?>" readonly>
        </div>

        <!-- PASSWORD -->
        <div class="form-group">
            <label>Password</label>
            <input type="text" value="<?= esc($user['password']) ?>" readonly>
        </div>

    </div>

    <!-- BUTTON -->
    <div class="form-action">
        <a href="/superadmin-user">
            <button type="button" class="btn-back">Kembali</button>
        </a>
    </div>

</div>

<?= $this->endSection() ?>