<?php
// session_start(); 
require 'db.php';

$nis = $_GET['nis'] ?? '';

$sql = "SELECT nama, nis FROM siswa WHERE nis = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nis);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

// if ($data) {
//     $_SESSION['akses_preview'] = true;
// }

echo json_encode([
    'found' => $data ? true : false,
    'nama' => $data['nama'] ?? null,
    'nis' => $data['nis'] ?? null
]);
