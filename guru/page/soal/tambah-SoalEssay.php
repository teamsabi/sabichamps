<?php
require_once '../../layout/top.php';
require_once '../../helper/conek.php';

$id_essay = '';
$pertanyaan = '';
$tanggal_buat = '';
$judul_soal = mysqli_query($conn, "SELECT judul_soal FROM soal");

// Mengecek apakah ada parameter 'ubah' di URL
if (isset($_GET['ubah'])) {
    $id_essay = $_GET['ubah'];

    // Query untuk mengambil data berdasarkan ID soal
    $query = "SELECT * FROM essay WHERE id_essay = '$id_essay'";
    $sql = mysqli_query($conn, $query);
    
    // Cek apakah data ditemukan
    if (mysqli_num_rows($sql) > 0) {
        $result = mysqli_fetch_assoc($sql);
        
        // Ambil data dari database
        $pertanyaan = $result['pertanyaan'];
        $tanggal_buat = $result['tanggal_buat'];
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
}
?>

<!--Content body start-->
<div class="content-body">
    <div class="container">
        <form method="POST" action="proses-SoalEssay.php">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-header mb-4">
                            <h4 class="card-title">Tambah Soal Essay</h4>
                        </div>
                        <div class="card-body">
                            <input type="hidden" value="<?php echo $id_essay; ?>" name="id_essay">
                            <div class="form-group row">
                                <label for="judul_soal" class="col-sm-3 col-form-label">Judul Soal</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="judul_soal" id="juduk_soal" required>
                                        <option value="">--Pilih Judul Soal--</option>
                                        <?php
                                        while ($r = mysqli_fetch_array($judul_soal)) :
                                        ?>
                                        <option value="<?= $r['judul_soal'] ?>"><?= $r['judul_soal'] ?></option>
                                        <?php
                                        endwhile;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pertanyaan" class="col-sm-3 col-form-label">Pertanyaan</label>
                                <div class="col-sm-9">
                                <textarea required name="pertanyaan" class="form-control summernote" id="pertanyaan"><?php echo $pertanyaan; ?></textarea>
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
                            <a href="SoalEssay.php" type="button" class="btn btn-danger btn-sm">
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
