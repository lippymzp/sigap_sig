<?php
$host = 'localhost';
$user = 'root';        // ganti kalau MySQL punya password
$pass = '';            // ganti sesuai password MySQL
$dbname = 'sigapsig';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    echo "❌ Koneksi gagal: " . $conn->connect_error . PHP_EOL;
} else {
    echo "✅ Koneksi database berhasil! Database: $dbname" . PHP_EOL;
}

$conn->close();