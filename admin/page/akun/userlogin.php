<?php
    require_once '../../layout/top.php';
    require_once '../../helper/conek.php';

    $query = 'SELECT * FROM user;';
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
                                <h4 class="card-title">Data Siswa</h4>
                            </div>

                            <!-- Button Tambah Akun -->
                            <div class="row mb-3">
                                <div class="col-lg-8 col-12" style="margin-top: -30px; margin-left: 120px;">
                                    <a href="kelola.php" class="btn" style="background-color: #229799; color: white;">
                                        <i class="fa fa-plus"></i> Tambah Data User
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="userTable" class="display" style="width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_assoc($sql)) { ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= ($row['username']); ?></td>
                                                    <td><?= ($row['email']); ?></td>
                                                    <td><?= ($row['password']); ?></td>
                                                    <td><?= ($row['role']); ?></td>
                                                    <td>
                                                        <a href="kelola.php?ubah=<?php echo $row['id_user']; ?>" type="button" class="btn btn-sm" style="background-color: #229799; color: white;">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="proses.php?hapus=<?= $row['id_user']; ?>" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?')">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Role</th>
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
                        var table = $('#userTable').DataTable();
                    });
                    </script>
                </div>
            </div>

        </div>
        <!--Content body end-->

<?php
require_once '../../layout/footer.php';
?>