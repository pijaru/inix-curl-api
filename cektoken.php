<?php
// if (isset($_SERVER['Authorization'])) {
//     $bearer = $_SERVER['Authorization'];
$req_header = apache_request_headers();
if (isset($req_header['Authorization'])) {
    $bearer = $req_header['Authorization'];
    // ekstrak tokennya
    $bearer_pisah = explode(' ', $bearer);
    // contoh = Bearer fiugaagwjkjda
    $token = $bearer_pisah[1]; // ambil tokennya
    // cocokan dengan yang di session
    session_start();
    $token_session = $_SESSION['token'];
    if ($token == $token_session) {
        // token valid, tidak perlu diapa-apakan
        // echo json_encode([
        //     "status"   => "token valid",
        //     "username" => $_SESSION['username'],
        // ]);
    } else {
        // tidak ada token
        exit(json_encode(["status" => "belum login"]));
    }
} else {
    // tidak ada token
    header("Content-type: application/json");
    exit(json_encode(["status" => "Belum Login"]));
}
?>