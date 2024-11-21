<?php
require_once '../../layout/top.php';
require_once '../../helper/conek.php';

$query = 'SELECT * FROM kelas;';
    $sql = mysqli_query($conn, $query);
    $no = 0;

?>


        <!--Content body start-->
        <div class="content-body badge-demo">
            <div class="container">
                <?php
                    if (isset($_GET['pesan']) && $_GET['pesan'] == 'hapus_sukses') {
                        echo "<div class='alert alert-success'>Data berhasil dihapus.</div>";
                    }
                ?>
                <!-- Table Kelas -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Data Kelas</h4>
                            </div>

                            <!-- Button tambah kelas -->
                            <div class="row mb-3">
                                <div class="col-lg-8 col-12" style="margin-top: -30px; margin-left: 120px;">
                                    <a href="kelola.php" class="btn btn-success">
                                        <i class="fa fa-plus"></i> Tambah Data Kelas
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="kelasTable" class="display" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Kelas</th>
                                                <th>Nama Kelas</th>
                                                <th>Jumlah Siswa</th>
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
                                                    <?php echo $result['kode_kelas']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['nama_kelas']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['jumlah_siswa']; ?>
                                                </td>
                                                <td>
                                                <a href="kelola.php?ubah=<?php echo $result['id_kelas']; ?>" type="button" class="btn btn-success btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="proses.php?hapus=<?php echo $result['id_kelas']; ?>" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data??')">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <a href="data_siswa.php?kode_kelas=<?php echo $result['kode_kelas']; ?>" type="button" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-eye"></i>
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
                                                <th>Kode Kelas</th>
                                                <th>Nama Kelas</th>
                                                <th>Jumlah Siswa</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
                        // Inisialisasi DataTable
                        const table = $('#kelasTable').DataTable();
                    });
                </script>
            </div>    
        </div>
        <!--Content body end-->

<?php
require_once '../../layout/footer.php';
?>