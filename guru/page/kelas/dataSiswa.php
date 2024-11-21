<?php
require_once '../../layout/top.php';
require_once '../../helper/conek.php';

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
                                        <td><?= ($row['nama_siswa']); ?></td>
                                        <td><?= ($row['email']); ?></td>
                                        <td><?= ($row['jenis_kelamin']); ?></td>
                                        <td><?= ($row['alamat']); ?></td>
                                        <td><?= ($row['telepon']); ?></td>
                                        <td><?= ($row['tanggal_lahir']); ?></td>
                                        <td><?= ($row['kelas']); ?></td>
                                        <td><?= ($row['nama_ortu']); ?></td>
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
