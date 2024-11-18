<?php
require_once '../../layout/top.php';
require_once '../../helper/conek.php';

// Ambil parameter kode_kelas dari URL
$kode_kelas = isset($_GET['kode_kelas']) ? $_GET['kode_kelas'] : '';

// Debugging untuk memastikan parameter diterima
if (empty($kode_kelas)) {
    echo 'Kode kelas tidak ditemukan di URL!';
    exit;
}

// Jika kode_kelas ada, lanjutkan dengan query untuk mendapatkan data siswa
$query = "SELECT s.id_siswa, s.nama_siswa, s.email, s.jenis_kelamin, s.alamat, s.telepon, 
          s.tanggal_lahir, k.nama_kelas, o.nama_ortu
          FROM siswa s
          JOIN kelas k ON s.kode_kelas = k.kode_kelas
          JOIN ortu o ON s.kode_ortu = o.kode_ortu
          WHERE s.kode_kelas = '$kode_kelas';";
$sql = mysqli_query($conn, $query);

// Cek apakah query berhasil
if (!$sql) {
    die('Query gagal: ' . mysqli_error($conn));
}

$no = 1;
?>

<!--Content body start-->
<div class="content-body">
    <div class="container">
        <!-- Table Siswa -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Siswa</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="siswaTable" class="display" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Email</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Kelas</th>
                                        <th>Ortu/Wali</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while ($row = mysqli_fetch_assoc($sql)) { ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($row['nama_siswa']); ?></td>
                                        <td><?= htmlspecialchars($row['email']); ?></td>
                                        <td><?= htmlspecialchars($row['jenis_kelamin']); ?></td>
                                        <td><?= htmlspecialchars($row['alamat']); ?></td>
                                        <td><?= htmlspecialchars($row['telepon']); ?></td>
                                        <td><?= htmlspecialchars($row['tanggal_lahir']); ?></td>
                                        <td><?= htmlspecialchars($row['nama_kelas']); ?></td>
                                        <td><?= htmlspecialchars($row['nama_ortu']); ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Email</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Kelas</th>
                                        <th>Ortu/Wali</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Inisialisasi DataTables -->
        <script>
            $(document).ready(function () {
                $('#siswaTable').DataTable();
            });
        </script>
    </div>
</div>
<!--Content body end-->

<?php
require_once '../../layout/footer.php';
?>
