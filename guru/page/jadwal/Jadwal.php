<?php
    require_once '../../layout/top.php';
    require_once '../../helper/conek.php';

    // Ambil data dari tabel 'jadwal'
    $query = 'SELECT * FROM jadwal;';
    $sql = mysqli_query($conn, $query);
    $no = 1;

    if (isset($_GET['status']) && isset($_GET['aksi'])) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>";
        if ($_GET['status'] == 'sukses' && $_GET['aksi'] == 'tambah') {
            echo "
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Jadwal belajar berhasil ditambahkan!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location = 'Jadwal.php';
                });
            ";
        } elseif ($_GET['status'] == 'sukses' && $_GET['aksi'] == 'edit') {
            echo "
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Jadwal belajar berhasil diperbarui!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location = 'Jadwal.php';
                });
            ";
        } elseif ($_GET['status'] == 'sukses' && $_GET['aksi'] == 'hapus') {
            echo "
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Jadwal belajar berhasil dihapus!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location = 'Jadwal.php';
                });
            ";
        } elseif ($_GET['status'] == 'gagal') {
            echo "
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Operasi gagal. Silakan coba lagi.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location = 'Jadwal.php';
                });
            ";
        }
        echo "</script>";
    }
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
                        <h4 class="card-title">Jadwal Kelas</h4>
                    </div>

                    <!-- Button Tambah Jadwal -->
                    <div class="row mb-3">
                        <div class="col-lg-8 col-12" style="margin-top: -30px; margin-left: 130px;">
                            <a href="tambah.php" class="btn" style="background-color: #229799; color: white;">
                                <i class="fa fa-plus"></i> Tambah Jadwal
                            </a>    
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="jadwalTable" class="display" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Hari</th>
                                        <th>Tanggal</th>
                                        <th>Tempat</th>
                                        <th>Nama Kelas</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Nama Guru</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($sql)) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= ($row['hari']); ?></td>
                                            <td><?= ($row['tanggal']); ?></td>
                                            <td><?= ($row['tempat']); ?></td>
                                            <td><?= ($row['nama_kelas']); ?></td>
                                            <td><?= ($row['mapel']); ?></td>
                                            <td><?= ($row['jam_mulai']); ?></td>
                                            <td><?= ($row['jam_selesai']); ?></td>
                                            <td><?= ($row['nama_guru']); ?></td>
                                            <td>
                                            <a href="tambah.php?ubah=<?php echo $row['id_jadwal']; ?>" type="button" class="btn btn-sm" style="background-color: #229799; color: white;">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0);" type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $row['id_jadwal']; ?>)">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Hari</th>
                                        <th>Tanggal</th>
                                        <th>Tempat</th>
                                        <th>Nama Kelas</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Nama Guru</th>
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
                    $('#jadwalTable').DataTable();
                });

                function confirmDelete(id) {
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect ke URL penghapusan jika dikonfirmasi
                            window.location.href = `proses.php?hapus=${id}`;
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
