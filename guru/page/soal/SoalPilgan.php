<?php
require_once '../../layout/top.php';
require_once '../../helper/conek.php';

// Ambil parameter judul_soal dari URL
$judul_soal = isset($_GET['judul_soal']) ? mysqli_real_escape_string($conn, $_GET['judul_soal']) : '';

// Inisialisasi variabel untuk data soal
$result = null;

// Mengecek apakah judul_soal valid
if ($judul_soal) {
    // Query untuk mengambil soal berdasarkan judul_soal
    $query = "SELECT id_pilgan, judul_soal, pertanyaan, opsi_a, opsi_b, opsi_c, opsi_d, opsi_e, kunci_jawaban, tanggal_buat 
              FROM pilgan WHERE judul_soal = ? ORDER BY tanggal_buat DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $judul_soal);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    echo "<script>alert('Judul soal tidak valid!'); window.location.href='BankSoal.php';</script>";
    exit;
}
$no = 1;
?>

<!-- Content body start -->
<div class="content-body">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Soal Pilihan Ganda: <?php echo htmlspecialchars($judul_soal); ?></h4>
                    </div>

                    <!-- Button Tambah Soal -->
                    <div class="row mb-3">
                        <div class="col-lg-8 col-12" style="margin-top: -30px; margin-left: 235px;">
                            <a href="tambah-SoalPilgan.php?judul_soal=<?php echo urlencode($judul_soal); ?>" class="btn" style="background-color: #229799; color: white;">
                                <i class="fa fa-plus"></i> Tambah Soal Pilgan
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="pilganTable" class="display" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pertanyaan</th>
                                        <th>Opsi A</th>
                                        <th>Opsi B</th>
                                        <th>Opsi C</th>
                                        <th>Opsi D</th>
                                        <th>Opsi E</th>
                                        <th>Kunci Jawaban</th>
                                        <th>Tanggal Buat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?php echo $row['pertanyaan']; ?></td>
                                            <td><?php echo $row['opsi_a']; ?></td>
                                            <td><?php echo $row['opsi_b']; ?></td>
                                            <td><?php echo $row['opsi_c']; ?></td>
                                            <td><?php echo $row['opsi_d']; ?></td>
                                            <td><?php echo $row['opsi_e']; ?></td>
                                            <td><?php echo $row['kunci_jawaban']; ?></td>
                                            <td><?php echo $row['tanggal_buat']; ?></td>
                                            <td>
                                                <a href="tambah-SoalPilgan.php?ubah=<?php echo $row['id_pilgan']; ?>&judul_soal=<?php echo urlencode($judul_soal); ?>" type="button" class="btn btn-sm" style="background-color: #229799; color: white;">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="proses-SoalPilgan.php?hapus=<?php echo $row['id_pilgan']; ?>&judul_soal=<?php echo urlencode($judul_soal); ?>" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?')">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Pertanyaan</th>
                                        <th>Opsi A</th>
                                        <th>Opsi B</th>
                                        <th>Opsi C</th>
                                        <th>Opsi D</th>
                                        <th>Opsi E</th>
                                        <th>Kunci Jawaban</th>
                                        <th>Tanggal Buat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="BuatSoal.php?judul_soal=<?php echo urlencode($judul_soal); ?>" type="button" class="btn btn-danger btn-sm">
                            <i class="fa fa-reply"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Inisialisasi DataTables -->
            <script>
                $(document).ready(function () {
                    $('#pilganTable').DataTable();
                });
            </script>
        </div>
    </div>
</div>
<!-- Content body end -->

<?php
require_once '../../layout/footer.php';
?>