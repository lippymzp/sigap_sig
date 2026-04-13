<?php
include 'koneksi.php';

$query = mysqli_query($conn,"SELECT * FROM kasus_influenza");

$data = array();

while($row = mysqli_fetch_assoc($query)){
$data[] = $row;
}

echo json_encode($data);
?>