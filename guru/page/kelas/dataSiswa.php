<?php
    require_once '../../layout/top.php';
    require_once '../../helper/conek.php';

    $kode_kelas = isset($_GET['kode_kelas']) ? $_GET['kode_kelas'] : null;

    if ($kode_kelas) {
        // Query untuk mengambil data siswa berdasarkan kode_kelas
        $query = "SELECT s.nama_siswa, s.jenis_kelamin, s.telepon, k.nama_kelas, s.alamat
                FROM siswa s
                INNER JOIN kelas k ON s.kelas = k.nama_kelas
                WHERE k.kode_kelas = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $kode_kelas);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $result = null; // Kosongkan jika tidak ada kode_kelas
    }


    $no = 0;

 ?>

        <!--Content body start-->
        <div class="content-body">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Kelas</h4>
                            </div>

                            <!-- Button Tambah Akun
                            <div class="row mb-3">
                                <div class="col-lg-8 col-12" style="margin-top: -30px; margin-left: 110px;">
                                    <a href="kelola.php" class="btn btn-success">
                                        <i class="fa fa-plus"></i> Tambah Data Guru
                                    </a>
                                </div>
                            </div> -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="siswaTable" class="display table-hover" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Siswa</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Telepon</th>
                                                <th>Kelas</th>
                                                <th>Alamat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($result && $result->num_rows > 0):
                                                while ($row = $result->fetch_assoc()): ?>
                                                <tr>
                                                <td><?php echo ++$no; ?>.</td>
                                                <td><?php echo $row['nama_siswa']; ?></td>
                                                <td><?php echo $row['jenis_kelamin']; ?></td>
                                                <td><?php echo $row['telepon']; ?></td>
                                                <td><?php echo $row['nama_kelas']; ?></td>
                                                <td><?php echo $row['alamat']; ?></td>
                                                </tr>
                                                <?php endwhile;
                                            else: ?>
                                                <tr>
                                                    <td colspan="7" class="text-center">Data tidak ditemukan</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Siswa</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Telepon</th>
                                                <th>Kelas</th>
                                                <th>Alamat</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a href="Kelas.php" type="button" class="btn btn-danger btn-sm">
                                    <i class="fa fa-reply"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>

                    <script>
                    $(document).ready(function () {
                        var table = $('#siswaTable').DataTable();
                    });
                    </script>
                </div>
            </div>

        </div>
        <!--Content body end-->



<?php
require_once '../../layout/footer.php';
?>