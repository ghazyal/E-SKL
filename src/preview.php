<?php
session_start();
if (!isset($_SESSION['akses_preview'])) {
    echo '
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Akses Ditolak</title>
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>
    <body>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Akses Ditolak",
                    text: "Silakan mulai dari halaman awal.",
                    icon: "error",
                    confirmButtonText: "Kembali",
                    allowOutsideClick: false
                }).then(() => {
                    window.location.href = "cetakskl.php"; 
                });
            });
        </script>
    </body>
    </html>';
    exit;
}

unset($_SESSION['akses_preview']);


?>



<?php
require 'db.php'; 
$nis = $_GET['nis'] ?? '';

$sql = "SELECT * FROM siswa WHERE nis = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nis);
$stmt->execute();
$result = $stmt->get_result();

if (!$row = $result->fetch_assoc()) {
    header("Location: cetakskl.html?error=notfound");
    exit;
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview E-SKL - <?= htmlspecialchars($row['nama']) ?></title>
    <style>
        .pdf-mode {
            margin-top: 30px !important;
            }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/sweetalert2.min.css">
    <link rel="icon" href="../assets/img/ico/smea-lg.svg">
    
</head>
<body>

    <div class="container mb-4 mt-2">
        <div class="row">
            <div class="col text-center">
                <button class="btn btn-success btn-sm shadow" onclick="downloadPDF()">Download PDF</button>
            </div>
        </div>
    </div>



    <div class="skl-box" style="font-family: 'Times New Roman', Times, serif;">
        <header>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-1 text-start">
                        <img src="../assets/img/ico/Logo Pemprov Jabar.png" alt="Logo Pemprov" width="95" class="mx-auto d-block mb-1">
                        <div class="">
                            <button class="btn btn-outline-primary text-black" disabled style="font-size: 0.6rem; padding: rem 1rem; line-height: 1; white-space: nowrap; opacity: 1; pointer-events: none;">NPSN : (masukkan nomor)</button>
                        </div>
                    </div>
                    <div class="col-11 text-center">
                        <h4 class="fw-bold" style="font-size: 16px;">PEMERINTAH DAERAH PROVINSI (isi provinsi) <br> <h3 class="" style="font-size: 18px; margin-top: -5px;">DINAS PENDIDIKAN</h3> </h4>
                        <h5 class="fw-bold" style="font-size: 14px; margin-top: -5px;">CABANG DINAS PENDIDIKAN (isi wilayah) <br> <h5 class="fw-bold" style="font-size: 14px; margin-top: -5px;">SEKOLAH MENENGAH KEJURUAN NEGERI (isi nama sekolah)</h5></h5>
                        <p class="small" style="margin-top: -8px; font-size: 12px;">(isi alamat dan no telp) 
                            <div class="row" style="margin-top: -15px;">
                                <div class="col">
                                    <p class="text-end" style="font-size: 12px;">Website : <a href="#">(masukan link website)</a></p>
                                </div>
                                <div class="col">
                                    <p class="text-start" style="font-size: 12px;">E-Mail : <a href="#">(masukkan email sekolah)</a></p>
                                </div>
                            </div>
                            
                            <p class="" style="margin-top: -15px; font-size: 12px; text-decoration: underline;">(masukkan kota dan kode pos)</p>
                        </p>
                    </div>
                </div>
            </div>
        </header>
        <div class="garis">
            <div class="container-fluid">
                <div class="row">
                    <div class="col text-center">
                        <div style="height: 3px; background-color: black; margin-bottom: 2px;"></div>
                        <div style="height: 1px; background-color: black;"></div>
                    </div>
                </div>
            </div>
        </div>
        <main>
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col text-center">
                                <h5 class="fw-bold text-decoration-underline" style="font-size: 14px;">
                                    SURAT KETERANGAN LULUS
                                </h5>
                                <p style="font-size: 12px;">
                                    Nomor : / / /2025
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <p style="font-size: 11px;">Kepala (sekolah) selaku Ketua Penyelenggara Ujian Sekolah Tahun Pelajaran 2024/2025, <br> berdasarkan :</p>
                                <ol style="font-size: 11px; padding-left: 1rem; margin-left: -5.5px; margin-top: -15px;">
                                    <li>Masukkan kriteria</li>
                                    <li>...</li>
                                    <li>...</li>
                                </ol>                              
                                <p style="font-size: 11px;">Menerangkan bahwa :</p>
                                <ul style="margin-left: 6%;">
                                    <table style="font-size: 11px; border-collapse: collapse;" class="border-0">
                                        <tr>
                                            <td style="border: none; padding-right: 5px;">Nama</td>
                                            <td style="border: none; padding-left: 0px; padding-right: 5px; width: 10px;">:</td>
                                            <td style="border: none;"><strong><?= htmlspecialchars($row['nama']) ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td style="border: none; padding-right: 5px;">Tempat dan Tanggal Lahir</td>
                                            <td style="border: none; padding-left: 0px; padding-right: 5px; width: 10px;">:</td>
                                            <td style="border: none;"><?= htmlspecialchars($row['ttl']) ?></td>
                                        </tr>
                                        <tr>
                                            <td style="border: none; padding-right: 5px;">Nomor Induk Siswa</td>
                                            <td style="border: none; padding-left: 0px; padding-right: 5px; width: 10px;">:</td>
                                            <td style="border: none;"><?= htmlspecialchars($row['nis']) ?></td>
                                        </tr>
                                        <tr>
                                            <td style="border: none; padding-right: 5px;">Nomor Induk Siswa Nasional</td>
                                            <td style="border: none; padding-left: 0px; padding-right: 5px; width: 10px;">:</td>
                                            <td style="border: none;"><?= htmlspecialchars($row['nisn']) ?></td>
                                        </tr>
                                        <tr>
                                            <td style="border: none; padding-right: 5px;">Kompetensi Keahlian (ganti kelas bagi SMA)</td>
                                            <td style="border: none; padding-left: 0px; padding-right: 5px; width: 10px;">:</td>
                                            <td style="border: none;"><?= htmlspecialchars($row['kompetensi_keahlian']) ?></td>
                                        </tr>
                                        <tr>
                                            <td style="border: none;"></td>
                                            <td style="border: none;"></td>
                                            <td style="border: none;"></td>
                                        </tr>
                                        <tr>
                                            <td style="border: none;"></td>
                                            <td style="border: none;"></td>
                                            <td style="border: none;"></td>
                                        </tr>
                                        <tr>
                                            <td style="border: none; padding-right: 5px;">Dinyatakan</td>
                                            <td style="border: none; padding-left: 0px; padding-right: 5px; width: 10px;">:</td>
                                            <td style="font-size: 16px; border: none;"><strong>LULUS</strong></td>
                                        </tr>
                                        <tr></tr>
                                    </table>
                                </ul>
                                <p style="font-size: 11px;">Dengan nilai sebagai berikut:</p>
                                <div class="table-responsive">
                                    <table class="table-bordered w-100" style="font-size: 11px; line-height: 1.2; border: 1px solid black; border-collapse: collapse;">
                                        <thead style="border: 1px solid black;">
                                            <tr class="text-center" style="background-color: lightgray;">
                                                <th scope="col">No</th>
                                                <th scope="col">Mata Pelajaran</th>
                                                <th scope="col">Nilai Ujian Sekolah</th>
                                            </tr>
                                        </thead>
                                        <tbody style="border: 1px solid black;">
                                            <tr>
                                                <th colspan="3" style="padding-left: 5px;">A.  Kelompok Mata Pelajaran Umum</th>
                                            </tr>
                                            <tr>
                                                <td scope="row" class="text-center">1.</td>
                                                <td style="padding-left: 5px;">Pendidikan Agama dan Budi Pekerti</td>
                                                <td class="text-center"><?= htmlspecialchars($row['pai']) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" class="text-center">2.</td>
                                                <td style="padding-left: 5px;">Pendidikan Pancasila</td>
                                                <td class="text-center"><?= htmlspecialchars($row['pkn']) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" class="text-center">3.</td>
                                                <td style="padding-left: 5px;">Bahasa Indonesia</td>
                                                <td class="text-center"><?= htmlspecialchars($row['b_ind']) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" class="text-center">4.</td>
                                                <td style="padding-left: 5px;">Pendidikan Jasmani, Olahraga, dan Kesehatan</td>
                                                <td class="text-center"><?= htmlspecialchars($row['pjok']) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" class="text-center">5.</td>
                                                <td style="padding-left: 5px;">Sejarah</td>
                                                <td class="text-center"><?= htmlspecialchars($row['sej']) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" class="text-center">6.</td>
                                                <td style="padding-left: 5px;">Seni Tari</td>
                                                <td class="text-center"><?= htmlspecialchars($row['tari']) ?></td>
                                            </tr>
                                            <tr>
                                                <th colspan="3" style="padding-left: 5px;">B.	Kelompok Mata Pelajaran Kejuruan</th>
                                            </tr>
                                            <tr>
                                                <td scope="row" class="text-center">1.</td>
                                                <td style="padding-left: 5px;">Matematika (Umum)</td>
                                                <td class="text-center"><?= htmlspecialchars($row['mat']) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" class="text-center">2.</td>
                                                <td style="padding-left: 5px;">Bahasa Inggris</td>
                                                <td class="text-center"><?= htmlspecialchars($row['b_ing']) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" class="text-center">3.</td>
                                                <td style="padding-left: 5px;">Informatika</td>
                                                <td class="text-center"><?= htmlspecialchars($row['info']) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" class="text-center">4.</td>
                                                <td style="padding-left: 5px;">Projek IPAS</td>
                                                <td class="text-center"><?= htmlspecialchars($row['ipas']) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" class="text-center">5.</td>
                                                <td style="padding-left: 5px;">Dasar-dasar Program Keahlian</td>
                                                <td class="text-center"><?= htmlspecialchars($row['dpk']) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" class="text-center">6.</td>
                                                <td style="padding-left: 5px;">Muatan Lokal Bahasa Daerah</td>
                                                <td class="text-center"><?= htmlspecialchars($row['b_sun']) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" class="text-center">7.</td>
                                                <td style="padding-left: 5px;">Kompetensi Keahlian</td>
                                                <td class="text-center"><?= htmlspecialchars($row['kk']) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" class="text-center">8.</td>
                                                <td style="padding-left: 5px;">Projek Kreatif dan Kewirausahaan</td>
                                                <td class="text-center"><?= htmlspecialchars($row['pkk']) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" class="text-center">9.</td>
                                                <td style="padding-left: 5px;">Bahasa Jepang</td>
                                                <td class="text-center"><?= htmlspecialchars($row['b_jpn']) ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row" class="text-center">10.</td>
                                                <td style="padding-left: 5px;">Mata Pelajaran Pilihan</td>
                                                <td class="text-center"><?= htmlspecialchars($row['mpkk']) ?></td>
                                            </tr>
                                            <tr class="text-center" style="background-color: lightgray;">
                                                <th colspan="2">Rata-rata</th>
                                                <th><?= number_format($row['rata_rata'], 2) ?></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row mt-3 position-relative">
                                    <div class="col-5">
                                        <img src="generate_qr.php?nis=<?= $row['nis'] ?>" width="100" alt="QR Code">
                                    </div>
                                    <div class="col-3">
                                        <img src="../assets/img/image/<?= htmlspecialchars($row['nis']) ?>.jpg" alt="Foto Siswa" class="foto-nis img-fluid" onerror="this.style.display='none'" width="90">
                                    </div>
                                    <div class="col-4 position-relative">
                                        <div class="ttd text-start" style="font-size: 11px; position: relative;">
                                            <p>(masukkan kota dan tanggal)</p>
                                            <p style="margin-top: -18px;">Kepala Sekolah,</p>

                                            <!-- tanda tangan -->
                                            <div class="tanda-tangan" style="position: absolute; top: 5px; left: -80px; z-index: 2;">
                                                <img src="../assets/img/ico/capttd.svg" alt="Tanda Tangan" style="width: 230px;">
                                            </div>

                                            <br><br><br>
                                            <p><strong>Nama Kepsek</strong></p>
                                            <p style="margin-top: -18px;">NIP Kepsek</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function downloadPDF() {
            const element = document.querySelector('.skl-box');

            const opt = {
                margin:       0.5,
                filename:     'SKL_<?= $nis ?>.pdf',
                image:        { type: 'jpeg', quality: 5.0 },
                html2canvas:  { scale: 5 },
                jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
            };

            html2pdf().set(opt).from(element).save();
        }
    </script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


</body>
</html>
