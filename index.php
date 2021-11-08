<?php

echo "ini adalah Server 1";

//akses ke server 2 dari server 1
//cURL

$ch  = curl_init();
$url = "http://localhost/server2/index.php";
//$url = "https://service.garasitekno.com/lokasi.php"; //endpoint

//set opsi curl
curl_setopt($ch, CURLOPT_URL, $url); //set alamat yang dituju//
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //ambil balasan berupa string

//eksekusi
$hasil = curl_exec($ch);

//tutup curl
curl_close($ch);

//tampilkan hasil
echo "<hr>";

//konversi string ke JSON
$hasil_json = json_decode($hasil);
print_r($hasil_json);