<?php
    require_once '../../layout/top.php';
    require_once '../../helper/conek.php';

    if ($id_soal) {
        // Query untuk mengambil soal berdasarkan id_soal
        $query = "SELECT e.judul_soal, e.pertanyaan, e.tanggal_buat
                FROM essay e
                INNER JOIN soal s ON e.judul_soal = s.judul_soal
                WHERE s.id_soal = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('e', $id_soal);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $result = null; // Kosongkan jika tidak ada kode_kelas
    }
    // Ambil data dari tabel 'soal'
    $query = "SELECT id_essay, judul_soal, pertanyaan, tanggal_buat FROM essay ORDER BY tanggal_buat DESC;";
    $sql = mysqli_query($conn, $query);    
    $no = 1;
?>

<!--Content body start-->
<div class="content-body">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Soal Essay</h4>
                    </div>

                    <!-- Button Tambah Soal -->
                    <div class="row mb-3">
                        <div class="col-lg-8 col-12" style="margin-top: -30px; margin-left: 110px;">
                            <a href="tambah-SoalEssay.php" class="btn" style="background-color: #229799; color: white;">
                                <i class="fa fa-plus"></i> Tambah Soal Essay
                            </a>    
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="essayTable" class="display" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Soal</th>
                                        <th>Pertanyaan</th>
                                        <th>Tanggal Buat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($result = mysqli_fetch_assoc($sql)){ ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?php echo $result['judul_soal']; ?></td>
                                            <td><?php echo $result['pertanyaan']; ?></td>
                                            <td><?php echo $result['tanggal_buat']; ?></td>
                                            <td>
                                                <a href="tambah-SoalEssay.php?ubah=<?php echo $result['id_essay']; ?>" type="button" class="btn btn-sm" style="background-color: #229799; color: white;">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="proses-SoalEssay.php?hapus=<?php echo $result['id_essay']; ?>" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?')">
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
                                        <th>Pertanyaan</th>
                                        <th>Tanggal Buat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                <div class="card-footer text-right">
                    <a href="BankSoal.php" type="button" class="btn btn-danger btn-sm">
                        <i class="fa fa-reply"></i> Kembali
                    </a>
            </div>
        </div>
    </div>

            <!-- Inisialisasi DataTables -->
            <script>
                $(document).ready(function () {
                    $('#essayTable').DataTable();
                });
            </script>
        </div>
    </div>
</div>
<!-- Content body end -->

<?php
require_once '../../layout/footer.php';
?>
