<?php
require_once '../../layout/top.php';
require_once '../../helper/config.php';

$kode_kelas = isset($_GET['kode_kelas']) ? $_GET['kode_kelas'] : null;

if ($kode_kelas) {
    // Query to fetch students based on the class code (kode_kelas)
    $query = "SELECT u.nama_lengkap AS nama_siswa, 
                     u.jenis_kelamin, 
                     u.telepon, 
                     k.nama_kelas, 
                     u.alamat
              FROM user u
              JOIN kelas_user ku ON u.id_user = ku.id_user
              JOIN kelas k ON ku.kode_kelas = k.kode_kelas
              WHERE ku.kode_kelas = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $kode_kelas); // Bind the kode_kelas parameter
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = null;
}

$no = 0;
?>

<!-- Content body start -->
<div class="content-body">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Siswa Kelas : <?php echo $kode_kelas; ?></h4>
                    </div>

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
                                            <td colspan="6" class="text-center">Data tidak ditemukan</td>
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
                        <a href="kelas.php" type="button" class="btn btn-danger btn-sm">
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
<!-- Content body end -->

<?php
require_once '../../layout/footer.php';
?>
