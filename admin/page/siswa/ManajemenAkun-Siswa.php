<?php
    require_once '../../layout/top.php';
    require_once '../../helper/conek.php';

    $query = 'SELECT * FROM siswa;';
        $sql = mysqli_query($conn, $query);
        $no = 0;

    $no = 0;

    // Pesan Status
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'sukses' && $_GET['aksi'] == 'tambah') {
            $pesan = "<div class='alert alert-success'>Data siswa berhasil ditambahkan!</div>";
        } elseif ($_GET['status'] == 'sukses' && $_GET['aksi'] == 'edit') {
            $pesan = "<div class='alert alert-success'>Data siswa berhasil diperbarui!</div>";
        } elseif ($_GET['status'] == 'sukses' && $_GET['aksi'] == 'hapus') {
            $pesan = "<div class='alert alert-success'>Data siswa berhasil dihapus!</div>";
        } elseif ($_GET['status'] == 'gagal') {
            $pesan = "<div class='alert alert-danger'>Operasi gagal. Silakan coba lagi.</div>";
        }
    }
?>
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
                                <h4 class="card-title">Data Siswa</h4>
                            </div>

                            <!-- Button Tambah Akun -->
                            <div class="row mb-3">
                                <div class="col-lg-8 col-12" style="margin-top: -30px; margin-left: 115px;">
                                    <a href="kelola.php" class="btn btn-success">
                                        <i class="fa fa-plus"></i> Tambah Data Siswa
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="guruTable" class="display" style="width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Siswa</th>
                                            <th>Email</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Telepon</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Kelas</th>
                                            <th>Orang Tua/Wali</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($result = mysqli_fetch_assoc($sql)){
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo ++$no; ?>.
                                                </td>
                                                <td>
                                                    <?php echo $result['nama_siswa']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['email']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['jenis_kelamin']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['telepon']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['tanggal_lahir']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['kelas']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['ortu_wali']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['alamat']; ?>
                                                </td>
                                                <td>
                                                    <a href="kelola.php?ubah=<?php echo $result['id_siswa']; ?>" type="button" class="btn btn-success btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="proses.php?hapus=<?php echo $result['id_siswa']; ?>" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data??')">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td> 
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Siswa</th>
                                            <th>Email</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Telepon</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Kelas</th>
                                            <th>Orang Tua/Wali</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                    $(document).ready(function () {
                        var table = $('#guruTable').DataTable();
                    });
                    </script>
                </div>
            </div>

        </div>
        <!--Content body end-->

<?php
require_once '../../layout/footer.php';
?>