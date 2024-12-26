<?php
    require_once '../../layout/top.php';
    require_once '../../helper/config.php';

    $query = 'SELECT * FROM user WHERE role = "guru"';

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
                                                    <?php echo $result['nama_lengkap']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['email']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['jenis_kelamin']; ?>
                                                </td>
                                                <td>
                                                    <img src="../../../assets2/img/foto_guru/<?php echo $result['foto_guru']; ?>" style="width: 70px;">
                                                </td>
                                                <td>
                                                    <?php echo $result['telepon']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['alamat']; ?>
                                                </td>
                                                <td>
                                                    <a href="kelola.php?ubah=<?php echo $result['id_user']; ?>" type="button" class="btn btn-success btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="#" type="button" 
                                                        class="btn btn-danger btn-sm" 
                                                        onclick="confirmDelete('<?php echo $result['id_user']; ?>')">
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