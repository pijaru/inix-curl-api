<?php
header("Content-type: application/json");
include 'cektoken.php';
// cek login

//baca perintah

//perintah ambil inventaris
if (!isset($_GET['perintah'])) {
    // tidak ada perintah
    header("Content-type: application/json");
    exit(json_encode(["status" => "masukkan perintah yang benar"]));
}
$perintah = $_GET['perintah'];
$ch       = curl_init();
if ($perintah == "ambil") {
    curl_setopt($ch, CURLOPT_URL, 'http://localhost/server2/inventaris/index.php');
} elseif ($perintah == "update") {
    // ambil id
    $id = $_GET['id'];

    //ambil data update
    $nama_inventaris   = $_POST['nama'];
    $jumlah_inventaris = $_POST['jumlah'];

    curl_setopt($ch, CURLOPT_URL, 'http://localhost/server2/inventaris/update.php?id=' . $id);
    curl_setopt($ch, CURLOPT_POST, true); //update post
    curl_setopt($ch, CURLOPT_POSTFIELDS, //body
        "nama=" . $nama_inventaris . "&jumlah=" . $jumlah_inventaris);
} elseif ($perintah == "simpan") {
    curl_setopt($ch, CURLOPT_URL, 'http://localhost/server2/inventaris/tambah.php');
    curl_setopt($ch, CURLOPT_POST, true); //kirim post

    $nama_inventaris   = $_POST['nama'];
    $jumlah_inventaris = $_POST['jumlah'];
    curl_setopt($ch, CURLOPT_POSTFIELDS, //body
        "nama=" . $nama_inventaris . "&jumlah=" . $jumlah_inventaris);
} elseif ($perintah == "hapus") {
    // ambil id
    $id = $_GET['id'];
    curl_setopt($ch, CURLOPT_URL, 'http://localhost/server2/inventaris/delete.php?id=' . $id);
    curl_setopt($ch, CURLOPT_POST, true);
} else {
    echo json_encode([
        "status" => "perintah salah",
    ]);
}

//eksekusi curl
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$hasil = curl_exec($ch);
curl_close($ch);

header("Content-type: application/json");

echo $hasil;

?>