<?php
// -------------------------
// Halaman BankSoal.php
// -------------------------
require_once '../../layout/top.php';
require_once '../../helper/conek.php';

// Ambil data dari tabel 'soal'
$query = 'SELECT * FROM soal;';
$sql = mysqli_query($conn, $query);
$no = 1;
?>

<!-- Content body start -->
<div class="content-body">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Bank Soal</h4>
                    </div>

                    <!-- Button Tambah Soal -->
                    <div class="row mb-3">
                        <div class="col-lg-8 col-12" style="margin-top: -30px; margin-left: 110px;">
                            <a href="tambah.php" class="btn" style="background-color: #229799; color: white;">
                                <i class="fa fa-plus"></i> Tambah Soal
                            </a>    
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="soalTable" class="display" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Soal</th>
                                        <th>Keterangan</th>
                                        <th>Detail Soal</th>
                                        <th>Telah Mengerjakan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($sql)) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?=($row['judul_soal']); ?></td>
                                            <td>
                                                <strong>Mata Pelajaran:</strong> <?= ($row['mapel']); ?><br>
                                                <strong>Kelas:</strong> <?= ($row['nama_kelas']); ?><br>
                                                <strong>Waktu Pengerjaan:</strong> <?= ($row['waktu_pengerjaan']); ?> menit <br>
                                                <strong>Info Soal:</strong> <?= ($row['info_soal']); ?>
                                            </td>
                                            <td>
                                                <a href="BuatSoal.php?judul_soal=<?= urlencode($row['judul_soal']); ?>" class="btn btn-warning btn-sm" style="color: white;">
                                                    <i class="fa fa-file-text"></i> Lihat Detail
                                                </a>
                                            </td>
                                            <td>
                                                <a href=".php?judul_soal=<?= urlencode($row['judul_soal']); ?>" class="btn btn-sm" style="background-color:rgb(26, 117, 236); color: white;">
                                                    <i class="fa fa-graduation-cap"></i> Hasil Pengerjaan Siswa
                                                </a>
                                            </td>
                                            <td>
                                                <a href="tambah.php?ubah=<?= $row['id_soal']; ?>" class="btn btn-sm" style="background-color: #229799; color: white;">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="proses.php?hapus=<?= $row['id_soal']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?')">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Soal</th>
                                        <th>Keterangan</th>
                                        <th>Detail Soal</th>
                                        <th>Telah Mengerjakan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inisialisasi DataTables -->
            <script>
                $(document).ready(function () {
                    $('#soalTable').DataTable();
                });
            </script>
        </div>
    </div>
</div>
<!-- Content body end -->

<?php
require_once '../../layout/footer.php';
?>