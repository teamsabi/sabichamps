<?php
    require_once '../../layout/top.php';
    require_once '../../helper/conek.php';

    $query = 'SELECT * FROM siswa;';
        $sql = mysqli_query($conn, $query);
        $no = 0;

    $no = 0;

    // Pesan Status
    if (isset($_GET['status']) && isset($_GET['aksi'])) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>";
        if ($_GET['status'] == 'sukses' && $_GET['aksi'] == 'tambah') {
            echo "
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data siswa berhasil ditambahkan!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            ";
        } elseif ($_GET['status'] == 'sukses' && $_GET['aksi'] == 'edit') {
            echo "
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data siswa berhasil diperbarui!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            ";
        } elseif ($_GET['status'] == 'sukses' && $_GET['aksi'] == 'hapus') {
            echo "
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data siswa berhasil dihapus!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            ";
        } elseif ($_GET['status'] == 'gagal') {
            echo "
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Operasi gagal. Silakan coba lagi.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            ";
        }
        echo "</script>";
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
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('<?php echo $result['id_siswa']; ?>')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
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

                    function confirmDelete(id) {
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Data ini akan dihapus secara permanen!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Arahkan ke proses.php dengan parameter hapus
                                window.location.href = `proses.php?hapus=${id}`;
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