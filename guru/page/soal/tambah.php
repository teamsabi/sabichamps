<?php
require_once '../../layout/top.php';
require_once '../../helper/conek.php';

$id_soal = '';
$judul_soal = '';
$mapel = '';
$nama_kelas = '';    
$waktu_pengerjaan = '';
$info_soal = '';
$kelas_soal = mysqli_query($conn, "SELECT nama_kelas FROM kelas");
$mata_pelajaran = mysqli_query($conn, "SELECT nama_mapel FROM mapel");

// Mengecek apakah ada parameter 'ubah' di URL
if (isset($_GET['ubah'])) {
    $id_soal = $_GET['ubah'];

    // Query untuk mengambil data berdasarkan ID soal
    $query = "SELECT * FROM jadwal WHERE id_soal = '$id_soal'";
    $sql = mysqli_query($conn, $query);
    
    // Cek apakah data ditemukan
    if (mysqli_num_rows($sql) > 0) {
        $result = mysqli_fetch_assoc($sql);
        
        // Ambil data dari database
        $judul_soal = $result['judul_soal'];
        $mapel = $result['mapel'];
        $nama_kelas = $result['nama_kelas'];
        $waktu_pengerjaan = $result['waktu_pengerjaan'];
        $info_soal = $result['info_soal'];
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
                            <h4 class="card-title">Tambah Soal</h4>
                        </div>
                        <div class="card-body">
                            <input type="hidden" value="<?php echo $id_soal; ?>" name="id_soal">
                            <div class="form-group row">
                                <label for="judulSoal" class="col-sm-3 col-form-label">Judul Soal</label>
                                <div class="col-sm-9">
                                    <input required="text" name="judul_soal" class="form-control" id="judulSoal" placeholder="Masukkan Judul Soal" value="<?php echo $judul_soal;?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mapel" class="col-sm-3 col-form-label">Mata Pelajaran</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="mapel" id="mapel" required>
                                        <option value="">--Pilih Mata Pelajaran--</option>
                                        <?php
                                        while ($r = mysqli_fetch_array($mata_pelajaran)) :
                                        ?>
                                        <option value="<?= $r['nama_mapel'] ?>"><?= $r['nama_mapel'] ?></option>
                                        <?php
                                        endwhile;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kelassiswa" class="col-sm-3 col-form-label">Kelas</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="nama_kelas" id="kelassiswa" required>
                                        <option value="">--Pilih Kelas--</option>
                                        <?php
                                        while ($r = mysqli_fetch_array($kelas_soal)) :
                                        ?>
                                        <option value="<?= $r['nama_kelas'] ?>"><?= $r['nama_kelas'] ?></option>
                                        <?php
                                        endwhile;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="waktuPengerjaan" class="col-sm-3 col-form-label">Waktu Pengerjaan</label>
                                <div class="col-sm-9">
                                    <input type="time" name="waktuPengerjaan" class="form-control" id="waktuPengerjaan" value="<?php echo $waktu_pengerjaan;?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="infoSoal" class="col-sm-3 col-form-label">Info Soal</label>
                                <div class="col-sm-9">
                                    <input required="textarea" name="infoSoal" class="form-control" id="infoSoal" placeholder="Masukkan Info Soal" value="<?php echo $info_soal;?>">
                                </div>
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
                            <a href="BankSoal.php" type="button" class="btn btn-danger btn-sm">
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