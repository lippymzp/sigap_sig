<?php include "koneksi.php"; ?>

<table class="table table-bordered">

<tr>
<th>Lokasi</th>
<th>Jumlah Kasus</th>
</tr>

<?php

$query=mysqli_query($conn,"SELECT * FROM kasus_influenza");

while($row=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?php echo $row['lokasi']; ?></td>
<td><?php echo $row['jumlah']; ?></td>

</tr>

<?php } ?>

</table>