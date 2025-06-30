<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-SKL</title>
    <link rel="icon" href="">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/sweetalert2.min.css">
    <!-- <link rel="icon" href="your icon"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        body {
            background-image: url(../assets/img/bg/bg.jpg);
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Poppins", sans-serif;
        }

        .glass-card {
            background: rgba(87, 87, 87, 0.1);
            backdrop-filter: blur(30px);
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            padding: 30px;
            color: rgb(255, 255, 255);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .my-small-title {
            font-size: 25px !important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
</head>
<body class="bg">
    <div id="fireworks-container" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 9999;"></div>

    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="glass-card" style="width: 20rem;">
                        <div class="text-center">
                            <img src="../assets/img/ico/smea-lg.svg" class="mb-2" style="width: 50px;" alt="your logo">
                            <h4 class="fw-bold mb-3">E-SURAT KELULUSAN</h4>
                            <div id="sklForm" class="mb-3">

                                <div class="form-group mb-4">
                                    <label for="nis" class="text-center fw-semibold text-white mb-2">Masukkan NIS</label>
                                    <input type="number" id="nisInput" class="form-control" placeholder="contoh : 1100111" required>
                                </div>
                                <button class="btn btn-primary w-100 fw-bolder" id="submitBtn">Validasi Kelulusan</button>
                            
                            </div>
                            <small class="text-secondary" style="font-size: 10px;">Build with love by Ghazy</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
        
    <footer>
        
    </footer>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const targetTime = localStorage.getItem("sklCountdown");

            if (!targetTime) {
                const now = new Date();
                const future = new Date('2025-05-05T00:00:00');  // atur tanggal dan jam buka
                // const future = new Date(now.getTime() + 1 * 1 * 1 * 5 * 1000); // testing 
                localStorage.setItem("sklCountdown", future.toISOString());
            }

            const endTime = new Date(localStorage.getItem("sklCountdown"));
            let interval;

            function tampilkanKriteria() {
                Swal.fire({
                    title: 'SK Kriteria Kelulusan',
                    html: `
                        <p class="" style="font-size: 12px;"><i>Silahkan baca kriteria kelulusan di bawah sebelum melanjutkan.</i></p>
                        <div class="zoom-controls" style="text-align: right; margin-bottom: 5px;">
                            <button id="zoomInBtn" class="btn btn-sm btn-secondary me-1" title="Perbesar">
                                <i class="fas fa-search-plus"></i>
                            </button>
                            <button id="zoomOutBtn" class="btn btn-sm btn-secondary" title="Perkecil">
                                <i class="fas fa-search-minus"></i>
                            </button>
                        </div>

                        <div id="gambarContainer" style="max-height: 400px; overflow-y: auto; border: 1px solid #ccc; padding: 10px;">
                            <img src="../assets/img/sk/SK_Kriteria-1.png" alt="SK-1" class="zoomable-img" style="width: 100%; transition: transform 0.3s; margin-bottom: 10px;">
                            <img src="../assets/img/sk/SK_Kriteria-2.png" alt="SK-2" class="zoomable-img" style="width: 100%; transition: transform 0.3s;">
                        </div>

                        <div class='mt-2'>
                            <button id="mengertiBtn" class="btn btn-success btn-sm" disabled>Saya Mengerti (15)</button>
                            <!-- <button id="downloadBtn" class="btn btn-warning btn-sm">Download SK</button> --!>
                        </div>
                    `,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        let counter = 15;
                        const btn = document.getElementById('mengertiBtn');
                        const interval = setInterval(() => {
                            counter--;
                            btn.textContent = `Saya Mengerti (${counter})`;
                            if (counter <= 0) {
                                clearInterval(interval);
                                btn.textContent = 'Saya Mengerti';
                                btn.disabled = false;
                            }
                        }, 1000);

                        let zoomLevel = 1;
                        document.getElementById('zoomInBtn').addEventListener('click', () => {
                            zoomLevel += 0.1;
                            document.querySelectorAll('.zoomable-img').forEach(img => {
                                img.style.transform = `scale(${zoomLevel})`;
                            });
                        });

                        document.getElementById('zoomOutBtn').addEventListener('click', () => {
                            zoomLevel = Math.max(0.5, zoomLevel - 0.1); // Jangan terlalu kecil
                            document.querySelectorAll('.zoomable-img').forEach(img => {
                                img.style.transform = `scale(${zoomLevel})`;
                            });
                        });


                        // document.getElementById('downloadBtn').addEventListener('click', () => {
                        //     const link = document.createElement('a');
                        //     link.href = 'SK_Kriteria.pdf';
                        //     link.download = 'SK_Kriteria_Kelulusan.pdf';
                        //     document.body.appendChild(link);
                        //     link.click();
                        //     document.body.removeChild(link);
                        // });

                        btn.addEventListener('click', () => {
                            Swal.fire({
                                title: `Imbauan <br> Bagi Peserta Didik`,
                                html: `
                                    <p style="margin-bottom:10px; font-size: 15px;">Baca dan pahami dengan seksama:</p>
                                    <div style="text-align:left; padding: 10px; font-size: 15px; border: 1px solid #ccc; border-radius: 5px;">
                                        <ol style="padding-left: 18px;">
                                            <li>Masukkan imbauan di sini.</li>
                                            <li>...</li>
                                            <li>...</li>
                                            <li>...</li>
                                            <li>...</li>
                                        </ol>
                                    </div>
                                    <div style="text-align:left; margin-top:10px;">
                                        <input type="checkbox" id="setujuCheckbox">
                                        <label for="setujuCheckbox" style="font-size: 15px;">Saya sudah membaca dan memahami aturan di atas.</label>
                                    </div>
                                `,
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Saya Setuju',
                                cancelButtonText: 'Batal',
                                allowOutsideClick: false,
                                preConfirm: () => {
                                    if (!document.getElementById('setujuCheckbox').checked) {
                                        Swal.showValidationMessage('Silakan centang pernyataan untuk melanjutkan.');
                                        return false;
                                    }
                                }
                            });
                        });
                    }
                });
            }



            function showCountdown() {
                const now = new Date();
                const msLeft = endTime - now;

                if (msLeft <= 0) {
                    clearInterval(interval);
                    Swal.close();
                    document.getElementById("sklForm").style.display = "block";

                    setTimeout(() => {
                        tampilkanKriteria();
                    }, 500);
                    return;
                }

                const days = Math.floor(msLeft / (1000 * 60 * 60 * 24));
                const hours = Math.floor((msLeft / (1000 * 60 * 60)) % 24);
                const minutes = Math.floor((msLeft / (1000 * 60)) % 60);
                const seconds = Math.floor((msLeft / 1000) % 60);

                Swal.update({
                    html: `Anda bisa cek setelah : <br><b style="color: #e74c3c;">${days} hari, ${hours} jam, ${minutes} menit, ${seconds} detik</b>`
                });
            }

            Swal.fire({
                title: 'Tidak dapat cek SKL',
                html: 'Menghitung waktu...',
                icon: 'info',
                showConfirmButton: false,
                allowOutsideClick: false,
                didOpen: () => {
                    showCountdown();
                    const icon = Swal.getHtmlContainer().parentElement.querySelector('.swal2-icon');
                    icon.style.borderColor = '#e74c3c';
                    icon.style.color = '#e74c3c';

                    interval = setInterval(showCountdown, 1000);
                }
            });
        });
    </script>

<script>
document.getElementById("submitBtn").addEventListener("click", function () {
    const nis = document.getElementById("nisInput").value;

    if (!nis) {
        Swal.fire({
            title: 'NIS Kosong!',
            text: 'Silakan masukkan NIS terlebih dahulu.',
            icon: 'warning',
            confirmButtonText: 'Kembali'
        });
        return;
    }

    Swal.fire({
        title: 'Memeriksa data...',
        html: 'Silakan tunggu sebentar.',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(`ceknis.php?nis=${nis}`)
        .then(response => response.json())
        .then(data => {
            setTimeout(() => {
                Swal.close(); 

                if (data.found) {
                    Swal.fire({
                        title: 'Selamat, Anda dinyatakan lulus!',
                        html: `
                            <p class="text-center">Atas nama</p>
                            <table style="margin: 0 auto; font-size: 14px;">
                                <tr>
                                    <td style="text-align: left;">Nama</td>
                                    <td style="padding: 0 8px;">:</td>
                                    <td class='fw-bold text-start'>${data.nama}</td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;">NIS</td>
                                    <td style="padding: 0 8px;">:</td>
                                    <td class='fw-bold text-start'>${data.nis}</td>
                                </tr>
                            </table>
                        `,
                        allowOutsideClick: false,
                        icon: 'success',
                        customClass: {
                            title: 'my-small-title'
                        },
                        confirmButtonText: 'Lihat Dokumen SKL',
                        didOpen: () => {
                            confetti({
                                particleCount: 350,
                                spread: 180,
                                origin: { y: 0.6 },
                                startVelocity: 50
                            });
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = `preview.php?nis=${nis}`;
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Data siswa tidak ditemukan. Pastikan NIS yang kamu masukkan benar.',
                        icon: 'error',
                        confirmButtonText: 'Coba Lagi'
                    });
                }
            }, 1000);
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Terjadi kesalahan!',
                text: 'Tidak dapat menghubungi server.',
                icon: 'error',
                confirmButtonText: 'Tutup'
            });
        });
});
</script>



           
</body>
</html>