<?php
    session_start();
    require_once '../../layout/top.php';
    require_once '../../helper/conek.php';

    // Ambil data dari tabel 'mapel'
    $query = 'SELECT * FROM mapel;';
    $sql = mysqli_query($conn, $query);
    $no = 1;

    if (isset($_SESSION['status']) && isset($_SESSION['aksi'])) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>";
        if ($_SESSION['status'] == 'sukses') {
            if ($_SESSION['aksi'] == 'tambah') {
                echo "
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Mata pelajaran berhasil ditambahkan!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                ";
            } elseif ($_SESSION['aksi'] == 'edit') {
                echo "
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Mata pelajaran berhasil diperbarui!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                ";
            } elseif ($_SESSION['aksi'] == 'hapus') {
                echo "
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Mata pelajaran berhasil dihapus!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                ";
            }
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
    
        // Hapus session agar tidak menampilkan SweetAlert lagi saat refresh
        unset($_SESSION['status']);
        unset($_SESSION['aksi']);
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
                        <h4 class="card-title">Mata Pelajaran</h4>
                    </div>

                    <!-- Button Tambah Materi -->
                    <div class="row mb-3">
                        <div class="col-lg-8 col-12" style="margin-top: -30px; margin-left: 150px;">
                            <a href="tambah.php" class="btn" style="background-color: #229799; color: white;">
                                <i class="fa fa-plus"></i> Tambah Mata Pelajaran
                            </a>    
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="mapelTable" class="display" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Mata Pelajaran</th>
                                        <th>Nama Mata Pelajaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($sql)) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= ($row['kode_mapel']); ?></td>
                                            <td><?= ($row['nama_mapel']); ?></td>
                                            <td>
                                            <a href="tambah.php?ubah=<?= $row['id_mapel']; ?>" type="button" class="btn btn-sm" style="background-color: #229799; color: white;">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0);" type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $row['id_mapel']; ?>)">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Mata Pelajaran</th>
                                        <th>Nama Mata Pelajaran</th>
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
                    $('#mapelTable').DataTable();
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
