<?php
$file = '../assets/document/SK_Kriteria.pdf';

if (!file_exists($file)) {
    die("File tidak ditemukan.");
}

header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="SK_Kriteria.pdf"');
header('Content-Length: ' . filesize($file));
readfile($file);
?>
