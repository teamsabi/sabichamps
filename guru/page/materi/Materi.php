<?php
    require_once '../../layout/top.php';
    require_once '../../helper/conek.php';

    // Ambil data dari tabel 'jadwal'
    $query = 'SELECT * FROM materi;';
    $sql = mysqli_query($conn, $query);
    $no = 1;
?>

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Materi</h4>
                    </div>

                    <!-- Button Tambah Materi -->
                    <div class="row mb-3">
                        <div class="col-lg-8 col-12" style="margin-top: -30px; margin-left: 130px;">
                            <a href="tambah.php" class="btn" style="background-color: #229799; color: white;">
                                <i class="fa fa-plus"></i> Tambah Materi
                            </a>    
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="materiTable" class="display" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Materi</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Nama Kelas</th>
                                        <th>File Materi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($sql)) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= ($row['judul_materi']); ?></td>
                                            <td><?= ($row['mapel']); ?></td>
                                            <td><?= ($row['nama_kelas']); ?></td>
                                            <td><?= ($row['file_materi']); ?></td>
                                            <td>
                                            <a href="tambah.php?ubah=<?= $row['kode_materi']; ?>" type="button" class="btn btn-sm" style="background-color: #229799; color: white;">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="proses.php?hapus=<?= $row['kode_materi']; ?>" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Materi</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Nama Kelas</th>
                                        <th>File Materi</th>
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
                    $('#materiTable').DataTable();
                });
            </script>
        </div>
    </div>
</div>
<!-- Content body end -->

<?php
require_once '../../layout/footer.php';
?>
