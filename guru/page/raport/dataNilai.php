<?php
    require_once '../../layout/top.php';
    require_once '../../helper/conek.php';

    // Ambil daftar mata pelajaran
    $queryMapel = "SELECT id_mapel, nama_mapel FROM mapel";
    $resultMapel = $conn->query($queryMapel);

    $mapelList = [];
    if ($resultMapel->num_rows > 0) {
        while ($rowMapel = $resultMapel->fetch_assoc()) {
            $mapelList[$rowMapel['id_mapel']] = $rowMapel['nama_mapel'];
        }
    }

    // Ambil data siswa
    $kode_kelas = isset($_GET['kode_kelas']) ? $_GET['kode_kelas'] : null;

    if ($kode_kelas) {
        // Query untuk mengambil data siswa berdasarkan kode_kelas
        $query = "SELECT s.id_siswa, s.nama_siswa, s.jenis_kelamin, s.telepon, k.nama_kelas, s.alamat
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
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="nilaiTable" class="display table-hover" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Siswa</th>
                                                <th>Kelas</th>
                                                <?php foreach ($mapelList as $mapel): ?>
                                                    <th><?php echo $mapel; ?></th>
                                                <?php endforeach; ?>
                                                <th>Nilai Rata-Rata</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($result && $result->num_rows > 0):
                                                while ($row = $result->fetch_assoc()): ?>
                                                <tr>
                                                <td><?php echo ++$no; ?>.</td>
                                                <td><?php echo $row['nama_siswa']; ?></td>
                                                <td><?php echo $row['nama_kelas']; ?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <a href="tambah.php?ubah=<?php echo $row['id_siswa']; ?>" type="button" class="btn btn-success btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="proses.php?hapus=<?php echo $row['id_siswa']; ?>" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data??')">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                                </tr>
                                                <?php endwhile; ?>
                                                    <?php else: ?>
                                                <tr>
                                                    <td colspan="<?php echo count($mapelList) + 4; ?>" class="text-center">Data tidak ditemukan</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Siswa</th>
                                                <th>Kelas</th>
                                                <?php foreach ($mapelList as $mapel): ?>
                                                    <th><?php echo $mapel; ?></th>
                                                <?php endforeach; ?>
                                                <th>Nilai Rata-Rata</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a href="Raport.php" type="button" class="btn btn-danger btn-sm">
                                    <i class="fa fa-reply"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>

                    <script>
                    $(document).ready(function () {
                        var table = $('#nilaiTable').DataTable();
                    });
                    </script>
                </div>
            </div>
        </div>
        <!--Content body end-->



<?php
require_once '../../layout/footer.php';
?>