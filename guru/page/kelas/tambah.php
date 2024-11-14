<?php
require_once '../../layout/top.php';
require_once '../../helper/conek.php';

$nama_kelas = '';
$jumlah_siswa = 0;

// Mengecek apakah ada parameter 'ubah' di URL
if (isset($_GET['ubah'])) {
    $kode_kelas = $_GET['ubah'];
    $query = "SELECT * FROM kelas WHERE kode_kelas = '$kode_kelas'";
    $sql = mysqli_query($conn, $query);

    if (mysqli_num_rows($sql) > 0) {
        $result = mysqli_fetch_assoc($sql);
        $nama_kelas = $result['nama_kelas'];

        // Hitung jumlah siswa
        $query_siswa = "SELECT COUNT(*) as total_siswa FROM siswa WHERE kode_kelas = '$kode_kelas'";
        $result_siswa = mysqli_query($conn, $query_siswa);
        $jumlah_siswa = mysqli_fetch_assoc($result_siswa)['total_siswa'];
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
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
                            <h4 class="card-title">Tambah Kelas</h4>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="kode_kelas" value="<?php echo isset($kode_kelas) ? $kode_kelas : ''; ?>">
                            <div class="form-group row">
                                <label for="namaKelas" class="col-sm-3 col-form-label">Nama Kelas</label>
                                <div class="col-sm-9">
                                    <input required="text" name="namaKelas" class="form-control" id="namaKelas" placeholder="Masukkan Nama Kelas" value="<?php echo $nama_kelas;?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jumlahSiswa" class="col-sm-3 col-form-label">Jumlah Siswa</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="jumlahSiswa" value="<?php echo $jumlah_siswa; ?>" readonly>
                                </div>
                            </div>
                        </div>
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
