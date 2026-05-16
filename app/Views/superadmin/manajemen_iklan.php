<?= $this->extend('layout/dashboard_superadmin') ?>
<?= $this->section('content') ?>

<div class="iklan-wrap">

    <div class="top-action">
        <button class="btn-add" onclick="showTambahConfirm()">
            <i class="fa-solid fa-circle-plus"></i>
            Tambah Iklan
        </button>
    </div>

    <div class="table-box">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Urutan</th>
                    <th>Preview</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if(!empty($iklan)): ?>
                    <?php foreach($iklan as $item): ?>
                    <tr>
                        <td><?= $item['urutan'] ?></td>

                        <td>
                            <img src="<?= base_url('uploads/iklan/' . $item['gambar']) ?>"
                                 class="preview-img">
                        </td>

                        <td><?= esc($item['judul']) ?></td>

                        <td>
                            <?= strlen($item['deskripsi']) > 40 ? substr($item['deskripsi'], 0, 40).'...' : $item['deskripsi']; ?>
                        </td>

                        <td>
                            <?php if($item['status'] == 'aktif'): ?>
                                <span class="badge-active">Aktif</span>
                            <?php else: ?>
                                <span class="badge-nonaktif">Non Aktif</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <button class="icon-btn edit"
                                onclick="window.location='<?= base_url('superadmin/iklan/edit/'.$item['id_iklan']) ?>'">
                                <i class="fa-solid fa-pen"></i>
                            </button>

                            <button class="icon-btn delete"
                                onclick="hapusConfirm(<?= $item['id_iklan'] ?>)">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            Belum ada iklan
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<style>
.iklan-wrap{
    padding:20px;
}

.top-action{
    margin-bottom:20px;
}

.btn-add{
    background:#E8B97B;
    border:none;
    color:white;
    padding:10px 22px;
    border-radius:25px;
    font-weight:600;
    box-shadow:0 4px 10px rgba(0,0,0,.12);
}

.btn-add i{
    margin-right:8px;
}

.table-box{
    background:#F6FFFF;
    border-radius:18px;
    padding:18px;
    border:1px solid #d8e8e8;
}

.table thead th{
    background:#EAF7F7;
    border:none;
    font-weight:700;
    color:#444;
    text-align:center;
}

.table tbody td{
    vertical-align:middle;
    text-align:center;
    border-color:#eef4f4;
}

.preview-img{
    width:240px;
    height:90px;
    object-fit:cover;
    border-radius:14px;
}

.badge-active{
    background:#C9F5CC;
    color:#3C9A42;
    padding:6px 18px;
    border-radius:20px;
    font-size:13px;
    font-weight:600;
}

.badge-nonaktif{
    background:#FFDADA;
    color:#D34D4D;
    padding:6px 18px;
    border-radius:20px;
    font-size:13px;
    font-weight:600;
}

.icon-btn{
    border:none;
    width:38px;
    height:38px;
    border-radius:10px;
    margin:0 4px;
    color:white;
}

.icon-btn.edit{
    background:#19C2D1;
}

.icon-btn.delete{
    background:#FF5B5B;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function showTambahConfirm(){
    Swal.fire({
        title:'Tambah Iklan',
        text:'Apakah anda yakin ingin menambah iklan?',
        icon:'question',
        showCancelButton:true,
        confirmButtonText:'Ya',
        cancelButtonText:'Tidak',
        confirmButtonColor:'#18C4CF'
    }).then((result)=>{
        if(result.isConfirmed){
            window.location.href = "<?= base_url('superadmin/iklan/tambah') ?>";
        }
    });
}

function hapusConfirm(id){
    Swal.fire({
        title:'Hapus Iklan',
        text:'Apakah anda yakin ingin menghapus iklan ini?',
        icon:'warning',
        showCancelButton:true,
        confirmButtonText:'Ya',
        cancelButtonText:'Tidak',
        confirmButtonColor:'#18C4CF'
    }).then((result)=>{
        if(result.isConfirmed){
            window.location.href = "<?= base_url('superadmin/iklan/hapus') ?>/" + id;
        }
    });
}
</script>

<?php if(session()->getFlashdata('success')): ?>
<script>
Swal.fire({
    icon:'success',
    title:'Berhasil',
    text:'<?= session()->getFlashdata('success') ?>',
    confirmButtonColor:'#18C4CF'
});
</script>
<?php endif; ?>

<?= $this->endSection() ?>