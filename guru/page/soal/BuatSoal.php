<?php
require_once '../../layout/top.php';
require_once '../../helper/conek.php';

// Ambil ID soal dari parameter 'id_soal'
$id_soal = isset($_GET['id_soal']) ? mysqli_real_escape_string($conn, $_GET['id_soal']) : '';

// Inisialisasi variabel untuk data soal
$judul_soal = '';
$mapel = '';
$nama_kelas = '';    
$waktu_pengerjaan = '';
$info_soal = '';

// Mengecek apakah ID soal valid
if ($id_soal) {
    // Query untuk mengambil data berdasarkan ID soal
    $query = "SELECT * FROM soal WHERE id_soal = '$id_soal'";
    $sql = mysqli_query($conn, $query);

    // Cek apakah data ditemukan
    if ($sql && mysqli_num_rows($sql) > 0) {
        $result = mysqli_fetch_assoc($sql);

        // Ambil data dari database
        $judul_soal = $result['judul_soal'];
        $mapel = $result['mapel'];
        $nama_kelas = $result['nama_kelas'];
        $waktu_pengerjaan = $result['waktu_pengerjaan'];
        $info_soal = $result['info_soal'];
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
}
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
                                <td><?php echo ($judul_soal); ?></td>
                            </tr>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <td><?php echo ($mapel); ?></td>
                            </tr>
                            <tr>
                                <th>Nama Kelas</th>
                                <td><?php echo ($nama_kelas); ?></td>
                            </tr>
                            <tr>
                                <th>Waktu Pengerjaan</th>
                                <td><?php echo ($waktu_pengerjaan);?> menit</td>
                            </tr>
                            <tr>
                                <th>Info Soal</th>
                                <td><?php echo ($info_soal); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer text-center">
                        <a href="SoalPilgan.php?id_soal=<?= $id_soal; ?>" class="btn btn-sm" style="background-color: #229799; color: white;">
                            Pilihan Ganda
                        </a>
                        <a href="SoalEssay.php?id_soal=<?= $id_soal; ?>" class="btn btn-warning btn-sm" style="color: white;">
                            Soal Essay
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--Content body end-->

<?php require_once '../../layout/footer.php'; ?>