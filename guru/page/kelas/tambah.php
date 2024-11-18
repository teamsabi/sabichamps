<?php
require_once '../../layout/top.php';
require_once '../../helper/conek.php';

// Fungsi untuk menghasilkan kode kelas otomatis
function generateKodeKelas($conn) {
    // Query untuk mendapatkan kode_kelas terakhir
    $query = "SELECT MAX(kode_kelas) AS kode_terakhir FROM kelas";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    $kodeTerakhir = $data['kode_terakhir'];
    $urutan = 1;

    if ($kodeTerakhir) {
        // Ambil angka dari kode terakhir, misalnya KLS001 -> 1
        $urutan = (int)substr($kodeTerakhir, 3) + 1;
    }

    // Format kode kelas baru, misalnya KLS002
    return "KLS" . str_pad($urutan, 3, "0", STR_PAD_LEFT);
}

// Jika form digunakan untuk mengedit data
if (isset($_GET['ubah'])) {
    $kode_kelas = $_GET['ubah'];
    $query = "SELECT * FROM kelas WHERE kode_kelas = '$kode_kelas'";
    $result = mysqli_query($conn, $query);
    $kelas = mysqli_fetch_assoc($result);
    if ($kelas) {
        $nama_kelas = $kelas['nama_kelas'];
        // Hitung jumlah siswa berdasarkan kode_kelas
        $query_siswa = "SELECT COUNT(*) as total_siswa FROM siswa WHERE kode_kelas = '$kode_kelas'";
        $result_siswa = mysqli_query($conn, $query_siswa);
        $jumlah_siswa = mysqli_fetch_assoc($result_siswa)['total_siswa'];
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
} else {
    // Generate kode kelas otomatis untuk tambah
    $kode_kelas = generateKodeKelas($conn);
    $nama_kelas = "";
    $jumlah_siswa = 0;
}
?>

<!--Content body start-->
<div class="content-body">
    <div class="container">
            <form method="POST" action="proses.php">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-header mb-4">
                            <h4 class="card-title"><?php echo isset($kode_kelas) ? 'Edit Kelas' : 'Tambah Kelas'; ?></h4>
                        </div>
                        <div class="card-body">
                            <!-- Input untuk Kode Kelas -->
                            <div class="form-group row">
                                <label for="kode_kelas" class="col-sm-3 col-form-label">Kode Kelas</label>
                                <div class="col-sm-9">
                                    <input type="text" id="kode_kelas" class="form-control" value="<?php echo isset($kode_kelas) ? $kode_kelas : generateKodeKelas($conn); ?>" disabled>
                                    <!-- Input hidden untuk mengirimkan kode_kelas ke server -->
                                    <input type="hidden" name="kode_kelas" value="<?php echo isset($kode_kelas) ? $kode_kelas : generateKodeKelas($conn); ?>">
                                </div>
                            </div>

                            <!-- Input untuk Nama Kelas -->
                            <div class="form-group row">
                                <label for="namaKelas" class="col-sm-3 col-form-label">Nama Kelas</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_kelas" class="form-control" id="namaKelas" placeholder="Masukkan Nama Kelas" value="<?php echo $nama_kelas; ?>" required>
                                </div>
                            </div>

                            <!-- Input untuk Jumlah Siswa -->
                            <div class="form-group row">
                                <label for="jumlahSiswa" class="col-sm-3 col-form-label">Jumlah Siswa</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="jumlahSiswa" value="<?php echo $jumlah_siswa; ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="card-footer text-right">
                            <button type="submit" name="aksi" value="<?php echo isset($kode_kelas) ? 'edit' : 'add'; ?>" class="btn btn-sm" style="background-color: #229799; color: white;">
                                <i class="fa fa-floppy-o"></i> Simpan
                            </button>
                            <a href="Kelas.php" type="button" class="btn btn-danger btn-sm">
                                <i class="fa fa-reply"></i> Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!--Content body end-->

<?php
require_once '../../layout/footer.php';
?>
