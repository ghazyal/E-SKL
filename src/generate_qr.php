<?php
require 'db.php';
require 'phpqrcode.php'; 

$nis = $_GET['nis'] ?? '';

$sql = "SELECT * FROM siswa WHERE nis = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nis);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($data) {
    $text = "TELAH DINYATAKAN LULUS | TAHUN 2025 | SMKN 1 SUBANG | " .
            strtoupper($data['kompetensi_keahlian']) . " | " .
            $data['nis'] . " | " . $data['nisn'] . " | " . strtoupper($data['nama']);

    header('Content-Type: image/png');
    QRcode::png($text);
} else {
    echo "Data siswa tidak ditemukan.";
}
