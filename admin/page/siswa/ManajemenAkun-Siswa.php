<?php
require_once '../../layout/top.php';
require_once '../../helper/config.php';

// Query untuk menampilkan data siswa
$query = 'SELECT u.id_user, u.nama_lengkap, u.jenis_kelamin, u.telepon, u.tanggal_lahir, u.nama_ortu_wali, u.alamat, u.email, k.nama_kelas
          FROM user u
          LEFT JOIN kelas_user ku ON u.id_user = ku.id_user
          LEFT JOIN kelas k ON ku.kode_kelas = k.kode_kelas
          WHERE u.role = "siswa"'; 

$sql = mysqli_query($conn, $query);
$no = 0;

// Pesan Status (Jika ada)
if (isset($_GET['status']) && isset($_GET['aksi'])) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>";
    if ($_GET['status'] == 'sukses' && $_GET['aksi'] == 'hapus') {
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

<!-- Content Body Start -->
<div class="content-body">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Siswa</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="guruTable" class="display table-hover" style="width: 100%;">
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
                                    <?php while($result = mysqli_fetch_assoc($sql)): ?>
                                    <tr>
                                        <td><?php echo ++$no; ?>.</td>
                                        <td><?php echo $result['nama_lengkap']; ?></td>
                                        <td><?php echo $result['email']; ?></td>
                                        <td><?php echo $result['jenis_kelamin']; ?></td>
                                        <td><?php echo $result['telepon']; ?></td>
                                        <td><?php echo $result['tanggal_lahir']; ?></td>
                                        <td><?php echo $result['nama_kelas']; ?></td>
                                        <td><?php echo $result['nama_ortu_wali']; ?></td>
                                        <td><?php echo $result['alamat']; ?></td>
                                        <td>
                                            <div style="display: flex; gap: 5px;">
                                                <a href="kelola.php?ubah=<?php echo $result['id_user']; ?>" class="btn btn-success btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('<?php echo $result['id_user']; ?>')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <script>
            $(document).ready(function () {
                $('#guruTable').DataTable();
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
                        window.location.href = `deleted.php?hapus=${id}`;
                    }
                });
            }
            </script>
        </div>
    </div>
</div>
<!-- Content Body End -->

<?php require_once '../../layout/footer.php'; ?>
