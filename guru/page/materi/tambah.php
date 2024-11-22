<?php
require_once '../../layout/top.php';
require_once '../../helper/conek.php';

$kodeMateri = '';
$judulMateri = '';
$mapel = '';    
$namaKelas = '';    
$fileMateri = '';

// Mengecek apakah ada parameter 'ubah' di URL
if (isset($_GET['ubah'])) {
    $kodeMateri = $_GET['ubah'];

    // Query untuk mengambil data berdasarkan Kode Materi
    $query = "SELECT * FROM materi WHERE kode_materi = '$kode_materi'";
    $sql = mysqli_query($conn, $query);
    
    // Cek apakah data ditemukan
    if (mysqli_num_rows($sql) > 0) {
        $result = mysqli_fetch_assoc($sql);
        
        // Ambil data dari database
        $kodeMateri = $result['kode_materi'];
        $judulMateri = $result['judul_materi'];
        $mapel = $result['mapel'];
        $namaKelas = $result['nama_kelas'];
        $fileMateri = $result['file_materi'];
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
}
?>

<!--Content body start-->
<div class="content-body">
    <div class="container">
        <form method="POST" action="proses.php" enctype="multipart/form-data">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-header mb-4">
                            <h4 class="card-title">Tambah Materi</h4>
                        </div>
                        <div class="card-body">
                            <input type="hidden" value="<?php echo $kodeMateri; ?>" name="kode_materi">
                            <div class="form-group row">
                                <label for="judulMateri" class="col-sm-3 col-form-label">Judul Materi</label>
                                <div class="col-sm-9">
                                    <input required ="text" name="judul_materi" class="form-control" id="judulMateri" placeholder="Masukkan Judul Materi" value="<?php echo $judulMateri;?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mapel" class="col-sm-3 col-form-label">Mata Pelajaran</label>
                                <div class="col-sm-9">
                                    <input required="text" name="mapel" class="form-control" id="mapel" placeholder="Masukkan Mata Pelajaran" value="<?php echo $mapel;?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="namaKelas" class="col-sm-3 col-form-label">Nama Kelas</label>
                                <div class="col-sm-9">
                                    <input required="text" name="nama_kelas" class="form-control" id="namaKelas" placeholder="Masukkan Nama Kelas" value="<?php echo $namaKelas;?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="file_materi" class="col-sm-3 col-form-label">File Materi</label>
                                <div class="col-sm-9">
                                    <input <?php if(!isset($_GET['ubah'])){ echo "required";} ?> class="form-control" type="file" name="file_materi" id="file_materi" accept="application/*">
                                    
                                </div>
                            </div>
                        <div class="card-footer text-right">
                            <?php if (isset($_GET['ubah'])) { ?>
                                <button type="submit" name="aksi" value="edit" class="btn btn-sm" style="background-color: #229799; color: white;">
                                    <i class="fa fa-floppy-o"></i> Simpan Perubahan
                                </button>
                            <?php } else { ?>
                                <button type="submit" name="aksi" value="add" class="btn btn-sm" style="background-color: #229799; color: white;">
                                    <i class="fa fa-floppy-o"></i> Simpan
                                </button>
                            <?php } ?>
                            <a href="Jadwal.php" type="button" class="btn btn-danger btn-sm">
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

