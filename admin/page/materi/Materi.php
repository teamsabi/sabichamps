<?php
require_once '../../layout/top.php';
require_once '../../helper/config.php';

// Ambil data dari tabel 'materi' dengan penambahan kolom file_materi dan tanggal_upload
$query = 'SELECT 
        materi.id_materi, 
        materi.judul_materi, 
        materi.file_materi,  -- Tambahkan kolom file_materi
        materi.tanggal_upload,  -- Tambahkan kolom tanggal_upload
        mapel.nama_mapel, 
        user.nama_lengkap
    FROM 
        materi
    JOIN 
        mapel ON materi.kode_mapel = mapel.kode_mapel
    JOIN 
        materi_siswa ON materi.id_materi = materi_siswa.id_materi
    JOIN 
        user ON materi_siswa.id_user = user.id_user';
$sql = mysqli_query($conn, $query);
$no = 1;

// Cek apakah ada status dan message di URL
$status = isset($_GET['status']) ? $_GET['status'] : null;
$message = isset($_GET['message']) ? $_GET['message'] : null;
?>

<!-- Content body start -->
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
                        <h4 class="card-title">Materi</h4>
                    </div>

                    <!-- Button Tambah Materi -->
                    <div class="row mb-3">
                        <div class="col-lg-8 col-12" style="margin-top: -30px; margin-left: 90px;">
                            <a href="kelola.php" class="btn" style="background-color: #229799; color: white;">
                                <i class="fa fa-plus"></i> Tambah Materi
                            </a>    
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="materiTable" class="display" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Materi</th>
                                        <th>Mata Pelajaran</th>
                                        <th>File Materi</th>
                                        <th>Nama Guru</th>
                                        <th>Tanggal Upload</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($sql)) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= ($row['judul_materi']); ?></td>
                                            <td><?= ($row['nama_mapel']); ?></td>
                                            <td><?= isset($row['file_materi']) ? $row['file_materi'] : ''; ?></td>
                                            <td><?= ($row['nama_lengkap']); ?></td>
                                            <td><?= isset($row['tanggal_upload']) ? $row['tanggal_upload'] : ''; ?></td>
                                            <td>
                                                <a href="kelola.php?ubah=<?= $row['id_materi']; ?>" type="button" class="btn btn-sm" style="background-color: #229799; color: white;">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="#" type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('<?= $row['id_materi']; ?>')">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Materi</th>
                                        <th>Mata Pelajaran</th>
                                        <th>File Materi</th>
                                        <th>Nama Guru</th>
                                        <th>Tanggal Upload</th>
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
                    $('#materiTable').DataTable();
                });

                function confirmDelete(kodeMateri) {
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
                            window.location.href = `proses.php?hapus=${kodeMateri}`;
                        }
                    });
                }
            </script>
        </div>
    </div>
</div>
<!-- Content body end -->

<?php
require_once '../../layout/footer.php';
?>
