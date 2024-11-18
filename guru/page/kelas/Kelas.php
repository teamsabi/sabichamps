<?php
require_once '../../layout/top.php';
require_once '../../helper/conek.php';

    // Ambil data dari tabel 'jadwal'
    $query = 'SELECT * FROM kelas;';
    $sql = mysqli_query($conn, $query);
    $no = 1;
 ?>

    <!--Content body start-->
    <div class="content-body">
        <div class="container">
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
                            <a href="tambah.php" class="btn" style="background-color: #229799; color: white;">
                                <i class="fa fa-plus"></i> Tambah Kelas
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
                                    <?php while ($row = mysqli_fetch_assoc($sql)) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= ($row['kode_kelas']); ?></td>
                                            <td><?= ($row['nama_kelas']); ?></td>
                                            <td><?= ($row['jumlah_siswa']); ?></td>
                                            <td>
                                            <a href="dataSiswa.php?kode_kelas=<?= $row['kode_kelas']; ?>" class="btn btn-sm lihatSiswa" style="background-color: #FFAA16; color: white;">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="tambah.php?ubah=<?php echo $row['kode_kelas']; ?>" type="button" class="btn btn-sm" style="background-color: #229799; color: white;">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="proses.php?hapus=<?= $row['kode_kelas']; ?>" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>No</th>
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
            <!-- Inisialisasi DataTables -->
            <script>
                $(document).ready(function () {
                    $('#kelasTable').DataTable();

                    // Event listener untuk semua tombol dengan class 'lihatSiswa'
                    $('.lihatSiswa').on('click', function (e) {
                        e.preventDefault(); // Mencegah perilaku default tombol
                        const url = $(this).attr('href'); // Ambil URL dari atribut href
                        console.log('Tombol diklik, menuju:', url);

                        // Redirect ke URL
                        window.location.href = url;
                    });
                });
            </script>
            </div>
                    
        <!--Content body end-->

<?php
require_once '../../layout/footer.php';
?>
