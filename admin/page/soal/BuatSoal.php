<?php
// -------------------------
// Halaman BuatSoal.php
// -------------------------
require_once '../../layout/top.php';
require_once '../../helper/conek.php';

$judul_soal = isset($_GET['judul_soal']) ? mysqli_real_escape_string($conn, $_GET['judul_soal']) : '';

// Ambil data berdasarkan judul_soal
$query = "SELECT * FROM soal WHERE judul_soal = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $judul_soal);
$stmt->execute();
$result = $stmt->get_result();
$soal = $result->fetch_assoc();
?>

<!--Content body start-->
<div class="content-body">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Detail Soal</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Judul Soal</th>
                                <td><?= $soal['judul_soal']; ?></td>
                            </tr>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <td><?= $soal['mapel']; ?></td>
                            </tr>
                            <tr>
                                <th>Nama Kelas</th>
                                <td><?= $soal['nama_kelas']; ?></td>
                            </tr>
                            <tr>
                                <th>Waktu Pengerjaan</th>
                                <td><?= $soal['waktu_pengerjaan']; ?> menit</td>
                            </tr>
                            <tr>
                                <th>Info Soal</th>
                                <td><?= $soal['info_soal']; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer text-center">
                        <a href="SoalPilgan.php?judul_soal=<?= urlencode($judul_soal); ?>" class="btn btn-sm" style="background-color: #229799; color: white;">
                            Pilihan Ganda
                        </a>
                        <a href="SoalEssay.php?judul_soal=<?= urlencode($judul_soal); ?>" class="btn btn-sm" style="background-color: #229799; color: white;">
                            Essay
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--Content body end-->

<?php require_once '../../layout/footer.php'; ?>