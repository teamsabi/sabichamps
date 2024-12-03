<?php
    require_once '../../layout/top.php';
    require_once '../../helper/conek.php';

    // Ambil ID soal dari URL
    $id_soal = isset($_GET['id_soal']) ? mysqli_real_escape_string($conn, $_GET['id_soal']) : '';

    if (!$id_soal) {
        die("ID Soal tidak ditemukan.");
    }

    // Ambil data dari tabel 'soal'
    $query = "SELECT id_essay, pertanyaan, tanggal_buat FROM essay ORDER BY tanggal_buat DESC";
    $result = mysqli_query($conn, $query);    
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
                                        <th>Pertanyaan</th>
                                        <th>Tanggal Buat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($sql)) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?php echo $result['pertanyaan']; ?></td>
                                            <td><?php echo $result['tanggal_buat']; ?></td>
                                            <td>
                                            <a href="tambah-SoalEssay.php?ubah=<?= $row['id_soal']; ?>" type="button" class="btn btn-sm" style="background-color: #229799; color: white;">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="proses-SoalEssay.php?hapus=<?= $row['id_soal']; ?>" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?')">
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
                                        <th>Tanggal Buat</th>
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
