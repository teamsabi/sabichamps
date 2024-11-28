<?php
require_once '../../layout/top.php';
require_once '../../helper/conek.php';

$kode_materi = '';
$judul_materi = '';
$mapel = '';
$nama_kelas = '';
$nama_guru = '';
$kelasjadwal = mysqli_query($conn, "SELECT nama_kelas FROM kelas");
$gurukelas = mysqli_query($conn, "SELECT nama_guru FROM guru");

// Mengecek apakah ada parameter 'ubah' di URL
if (isset($_GET['ubah'])) {
    $kode_materi = $_GET['ubah'];

    // Query untuk mengambil data berdasarkan ID jadwal
    $query = "SELECT * FROM materi WHERE kode_materi = '$kode_materi'";
    $sql = mysqli_query($conn, $query);
    
    // Cek apakah data ditemukan
    if (mysqli_num_rows($sql) > 0) {
        $result = mysqli_fetch_assoc($sql);
        
        // Ambil data dari database
        $kode_materi = $result['kode_materi'];
        $judul_materi = $result['judul_materi'];
        $mapel = $result['mapel'];
        $nama_kelas = $result['nama_kelas'];
        $nama_guru = $result['nama_guru'];
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
                            <input type="hidden" value="<?php echo $kode_materi; ?>" name="kode_materi">
                            <div class="form-group row">
                                <label for="judulmateri" class="col-sm-3 col-form-label">Judul Materi</label>
                                <div class="col-sm-9">
                                    <input required="text" name="judul_materi" class="form-control" id="judulmateri" placeholder="Namakan Judul Materi" value="<?php echo $judul_materi;?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mapel" class="col-sm-3 col-form-label">Mata Pelajaran</label>
                                <div class="col-sm-9">
                                    <input required="text" name="mapel" class="form-control" id="mapel" placeholder="Masukkan Mata Pelajaran" value="<?php echo $mapel;?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kelasmateri" class="col-sm-3 col-form-label">Kelas</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="nama_kelas" id="kelasmateri" required>
                                        <option value="">--Pilih Kelas--</option>
                                        <?php
                                        while ($r = mysqli_fetch_array($kelasjadwal)) :
                                        ?>
                                        <option value="<?= $r['nama_kelas'] ?>"><?= $r['nama_kelas'] ?></option>
                                        <?php
                                        endwhile;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="filemateri" class="col-sm-3 col-form-label">File Materi</label>
                                <div class="col-sm-9">
                                    <input <?php if(!isset($_GET['ubah'])){ echo "required";} ?> type="file" name="file_materi" class="form-control-file" id="filemateri">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="gurumateri" class="col-sm-3 col-form-label">Nama Guru</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="nama_guru" id="gurumateri" required>
                                        <option value="">--Pilih Guru Pengajar--</option>
                                        <?php
                                        while ($r = mysqli_fetch_array($gurukelas)) :
                                        ?>
                                        <option value="<?= $r['nama_guru'] ?>"><?= $r['nama_guru'] ?></option>
                                        <?php
                                        endwhile;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <?php
                                    if(isset($_GET['ubah'])){ 
                            ?>
                                    <button type="submit" name="aksi" value="edit" class="btn btn-success btn-sm">
                                        <i class="fa fa-floppy-o"></i> Simpan Perubahan
                                    </button>
                            <?php
                                    }else{
                            ?>
                                    <button type="submit" name="aksi" value="add" class="btn btn-success btn-sm">
                                        <i class="fa fa-floppy-o"></i> Simpan
                                    </button>
                            <?php
                                    }
                            ?>
                            <a href="Materi.php" type="button" class="btn btn-danger btn-sm">
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