<?php
require_once '../../layout/top.php';
require_once '../../helper/conek.php';

$query = "SELECT k.id_kelas, k.kode_kelas, k.nama_kelas,
        COUNT(s.id_siswa) AS jumlah_siswa
        FROM kelas k
        LEFT JOIN siswa s ON k.nama_kelas = s.kelas
        GROUP BY k.id_kelas, k.kode_kelas, k.nama_kelas";

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
                                <h4 class="card-title">Raport Siswa</h4>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="raportTable" class="display" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kelas</th>
                                                <th>Jumlah Siswa</th>
                                                <th>Nilai Rata-Rata</th>
                                                <th>Detail</th>
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
                                                    <?php echo $result['nama_kelas']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['jumlah_siswa']; ?>
                                                </td>
                                                <td></td>
                                                <td>
                                                <a href="dataNilai.php?kode_kelas=<?php echo $result['kode_kelas']; ?>" type="button" class="btn btn-warning btn-sm"style="background-color: #FFAA16; color: white;">
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
                                                <th>No</th>
                                                <th>Kelas</th>
                                                <th>Jumlah Siswa</th>
                                                <th>Nilai Rata-Rata</th>
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
                        const table = $('#raportTable').DataTable();
                    });
                </script>
            </div>    
        </div>
        <!--Content body end-->

<?php
require_once '../../layout/footer.php';
?>