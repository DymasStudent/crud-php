<?php

// render halaman menjadi json
header('Content-Type: application/json');

require '../config/app.php';

// menerima input
$nama = $_POST['nama'];
$jumlah = $_POST['jumlah'];
$harga = $_POST['harga'];

// validasi data
if ($nama == null) {
 echo json_encode(['pesan' => 'Kolom Nama Harus Di ISI ...']);
 exit;
}

// query tambah data
$query = "INSERT INTO administrasi VALUES (null, '$nama', '$jumlah', '$harga', CURRENT_TIMESTAMP())";
mysqli_query($db, $query);

// check status data
if ($query) {
 echo json_encode(['pesan' => 'Data Behasil Ditambahkan']);
} else {
 echo json_encode(['pesan' => 'Data Gagal Ditambahkan']);
}