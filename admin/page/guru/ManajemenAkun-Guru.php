<?php
    require_once '../../layout/top.php';
    require_once '../../helper/conek.php';

    $query = 'SELECT * FROM guru;';
    $sql = mysqli_query($conn, $query);
    $no = 0;

    // Cek apakah ada status dan message di URL
    $status = isset($_GET['status']) ? $_GET['status'] : null;
    $message = isset($_GET['message']) ? $_GET['message'] : null;
 ?>

        <!--Content body start-->
        <div class="content-body">
            <div class="container">
                <?php if ($status && $message): ?>
                    <script>
                        Swal.fire({
                            icon: '<?php echo $status === "success" ? "success" : "error"; ?>',
                            title: '<?php echo $status === "success" ? "Berhasil" : "Gagal"; ?>',
                            text: '<?php echo $message; ?>',
                            confirmButtonText: 'OK'
                        });
                    </script>
                <?php endif; ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Data Guru</h4>
                            </div>

                            <!-- Button Tambah Akun -->
                            <div class="row mb-3">
                                <div class="col-lg-8 col-12" style="margin-top: -30px; margin-left: 110px;">
                                    <a href="kelola.php" class="btn btn-success">
                                        <i class="fa fa-plus"></i> Tambah Data Guru
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="guruTable" class="display table-hover" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama Guru</th>
                                                <th>Email</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Foto Profil</th>
                                                <th>Telepon</th>
                                                <th>Alamat</th>
                                                <th>Tanggal Buat</th>
                                                <th style="width: 200">Aksi</th>
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
                                                    <?php echo $result['nama_guru']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['email']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['jenis_kelamin']; ?>
                                                </td>
                                                <td>
                                                    <img src="../../images/foto_guru/<?php echo $result['foto_guru']; ?>" style="width: 70px;">
                                                </td>
                                                <td>
                                                    <?php echo $result['telepon']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['alamat']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['created_at']; ?>
                                                </td>
                                                <td>
                                                    <a href="kelola.php?ubah=<?php echo $result['kode_guru']; ?>" type="button" class="btn btn-success btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="#" type="button" 
                                                        class="btn btn-danger btn-sm" 
                                                        onclick="confirmDelete('<?php echo $result['kode_guru']; ?>')">
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
                                                <th>Nama Guru</th>
                                                <th>Email</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Foto Profil</th>
                                                <th>Telepon</th>
                                                <th>Alamat</th>
                                                <th>Tanggal Buat</th>
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

                    function confirmDelete(kodeGuru) {
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Data guru akan dihapus secara permanen!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirect ke URL hapus
                                window.location.href = `proses.php?hapus=${kodeGuru}`;
                            }
                        });
                    }
                    </script>
                </div>
            </div>

        </div>
        <!--Content body end-->



<?php
require_once '../../layout/footer.php';
?>