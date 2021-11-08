<?php
// login

// database
include "database.php";
include 'jwt.php';

//ambil kiriman username dan password

$username = $_POST['username'];
$password = md5($_POST['password']);

// cek database
$query = "SELECT * FROM user WHERE username='$username' AND password='$password';";
$hasil = mysqli_query($koneksi, $query);

//cek apakah ada yang cocok
$jumlah = mysqli_num_rows($hasil);
if ($jumlah > 0) {
    // token
    // $md5_username = md5($username);
    // $md5_password = md5($password);
    // $rahasia      = md5("abc12345");

    // //gabung
    $token = buat_jwt($username);

    //simpan ke session
    session_start();
    $_SESSION['token']    = $token;
    $_SESSION['username'] = $username;

    // login berhasil
    header("Content-type: application/json");
    echo json_encode([
        "status" => "berhasil login",
        "token"  => $token,
    ]);
} else {
    // gagal login
    echo json_encode(["status" => "Gagal login!"]);
}

?>