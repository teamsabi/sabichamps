<?php
    require_once '../../layout/top.php';
    require_once '../../helper/conek.php';

    $query = 'SELECT * FROM guru;';
    $sql = mysqli_query($conn, $query);
    $no = 0;
 ?>

        <!--Content body start-->
        <div class="content-body">
            <div class="container">
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
                            <!-- <div class="alert alert-info alert-dismissible fade show" role="alert" style=" margin-left: 20px; margin-right: 20px;">
                                <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div> -->
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
                                                <a href="proses.php?hapus=<?php echo $result['kode_guru']; ?>" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data??')">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                        <!-- <tfoot>
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
                                        </tfoot> -->
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