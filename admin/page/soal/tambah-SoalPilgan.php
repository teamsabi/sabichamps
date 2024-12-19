<?php
require_once '../../layout/top.php';
require_once '../../helper/conek.php';

$id_pilgan = '';
$pertanyaan = '';
$opsi_a = '';
$opsi_b = '';
$opsi_c = '';
$opsi_d = '';
$opsi_e = '';
$kunci_jawaban = '';
$tanggal_buat = '';
$judul_soal = mysqli_query($conn, "SELECT judul_soal FROM soal");

// Mengecek apakah ada parameter 'ubah' di URL
if (isset($_GET['ubah'])) {
    $id_pilgan = $_GET['ubah'];

    // Query untuk mengambil data berdasarkan ID soal
    $query = "SELECT * FROM pilgan WHERE id_pilgan = '$id_pilgan'";
    $sql = mysqli_query($conn, $query);
    
    // Cek apakah data ditemukan
    if (mysqli_num_rows($sql) > 0) {
        $result = mysqli_fetch_assoc($sql);
        
        // Ambil data dari database
        $pertanyaan = $result['pertanyaan'];
        $opsi_a = $result['opsi_a'];
        $opsi_b = $result['opsi_b'];
        $opsi_c = $result['opsi_c'];
        $opsi_d = $result['opsi_d'];
        $opsi_e = $result['opsi_e'];
        $kunci_jawaban = $result['kunci_jawaban'];
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
        <form method="POST" action="proses-SoalPilgan.php">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-header mb-4">
                            <h4 class="card-title">Tambah Soal Pilihan Ganda</h4>
                        </div>
                        <div class="card-body">
                            <input type="hidden" value="<?php echo $id_pilgan; ?>" name="id_pilgan">
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
                            <div class="form-group row">
                                <label for="opsi_a" class="col-sm-3 col-form-label">Opsi A</label>
                                <div class="col-sm-9">
                                    <textarea required name="opsi_a" class="form-control summernote" id="opsi_a"><?php echo $opsi_a; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="opsi_b" class="col-sm-3 col-form-label">Opsi B</label>
                                <div class="col-sm-9">
                                    <textarea required name="opsi_b" class="form-control summernote" id="opsi_b"><?php echo $opsi_b; ?></textarea>
                                </div>                            
                            </div>                            
                            <div class="form-group row">
                                <label for="opsi_c" class="col-sm-3 col-form-label">Opsi C</label>
                                <div class="col-sm-9">
                                    <textarea required name="opsi_c" class="form-control summernote" id="opsi_c"><?php echo $opsi_c; ?></textarea>
                                </div>                            
                            </div>                            
                            <div class="form-group row">
                                <label for="opsi_d" class="col-sm-3 col-form-label">Opsi D</label>
                                <div class="col-sm-9">
                                <textarea required name="opsi_d" class="form-control summernote" id="opsi_d"><?php echo $opsi_d; ?></textarea>
                                </div>                            
                            </div>                            
                            <div class="form-group row">
                                <label for="opsi_e" class="col-sm-3 col-form-label">Opsi E</label>
                                <div class="col-sm-9">
                                    <textarea required name="opsi_e" class="form-control summernote" id="opsi_e"><?php echo $opsi_e; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kunci_jawaban" class="col-sm-3 col-form-label">Kunci Jawaban</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="kunci_jawaban" id="kunci_jawaban" required>
                                        <option value="">--Pilih Kunci Jawaban--</option>
                                        <option value="A" <?php echo isset($kunci_jawaban) && $kunci_jawaban === 'A' ? 'selected' : ''; ?>>A</option>
                                        <option value="B" <?php echo isset($kunci_jawaban) && $kunci_jawaban === 'B' ? 'selected' : ''; ?>>B</option>
                                        <option value="C" <?php echo isset($kunci_jawaban) && $kunci_jawaban === 'C' ? 'selected' : ''; ?>>C</option>
                                        <option value="D" <?php echo isset($kunci_jawaban) && $kunci_jawaban === 'D' ? 'selected' : ''; ?>>D</option>
                                        <option value="E" <?php echo isset($kunci_jawaban) && $kunci_jawaban === 'E' ? 'selected' : ''; ?>>E</option>
                                    </select>
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
                            <a href="SoalPilgan.php" type="button" class="btn btn-danger btn-sm">
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
