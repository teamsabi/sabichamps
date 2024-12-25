<?php
session_start();
require_once '../../layout/top.php';
require_once '../../helper/config.php';

$query = "SELECT 
            k.kode_kelas, 
            k.nama_kelas, 
            COUNT(u.id_user) AS jumlah_siswa
        FROM 
            kelas k
        LEFT JOIN 
            kelas_user ku ON k.kode_kelas = ku.kode_kelas
        LEFT JOIN 
            user u ON ku.id_user = u.id_user AND u.role = 'siswa'
        GROUP BY 
            k.kode_kelas, k.nama_kelas;
        ";

$sql = mysqli_query($conn, $query);
$no = 0;

// Tampilkan SweetAlert jika ada session status
if (isset($_SESSION['status']) && isset($_SESSION['aksi'])) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>";
    if ($_SESSION['status'] == 'sukses' && $_SESSION['aksi'] == 'tambah') {
        echo "
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data Kelas berhasil ditambahkan!',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        ";
    } elseif ($_SESSION['status'] == 'sukses' && $_SESSION['aksi'] == 'edit') {
        echo "
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data Kelas berhasil diperbarui!',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        ";
    } elseif ($_SESSION['status'] == 'sukses' && $_SESSION['aksi'] == 'hapus') {
        echo "
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data Kelas berhasil dihapus!',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        ";
    } elseif ($_SESSION['status'] == 'gagal') {
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
    unset($_SESSION['status']);
    unset($_SESSION['aksi']);
}
?>

<!-- Content body start -->
<div class="content-body badge-demo">
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
                                    <td><?php echo ++$no; ?>.</td>
                                    <td><?php echo $result['kode_kelas']; ?></td>
                                    <td><?php echo $result['nama_kelas']; ?></td>
                                    <td><?php echo $result['jumlah_siswa']; ?></td>
                                    <td>
                                        <a href="kelola.php?ubah=<?php echo $result['kode_kelas']; ?>" type="button" class="btn btn-success btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('<?php echo $result['kode_kelas']; ?>')">
                                            <i class="fa fa-trash"></i>
                                        </button>
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
        </div>
        <script>
            $(document).ready(function () {
                // Inisialisasi DataTable
                const table = $('#kelasTable').DataTable();
            });

            function confirmDelete(kode_kelas) {
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
                        window.location.href = 'proses.php?hapus=' + kode_kelas;
                    }
                });
            }
        </script>
    </div>    
</div>
<!-- Content body end -->

<?php
require_once '../../layout/footer.php';
?>
