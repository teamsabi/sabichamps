<?php
require_once '../../layout/top.php';
require_once '../../helper/config.php';

$id_user = '';
$nama_lengkap = '';
$jenis_kelamin = '';
$telepon = '';
$tanggal_lahir = '';
$kelas = '';
$ortu = '';
$alamat = '';

// Menambahkan query untuk mengambil nama kelas berdasarkan id_user
if(isset($_GET['ubah'])){
    $id_user = $_GET['ubah'];

    // Query untuk mengambil data siswa berdasarkan id_user
    $query = "SELECT * FROM user WHERE id_user = '$id_user';";
    $sql = mysqli_query($conn, $query);

    // Ambil data siswa
    $result = mysqli_fetch_assoc($sql);

    $nama_lengkap = $result['nama_lengkap'];
    $email = $result['email'];
    $jenis_kelamin = $result['jenis_kelamin'];
    $telepon = $result['telepon'];
    $tanggal_lahir = $result['tanggal_lahir'];
    $ortu = $result['nama_ortu_wali'];
    $alamat = $result['alamat'];

    // Query untuk mengambil nama kelas berdasarkan id_user
    $kelas_siswa = mysqli_query($conn, "SELECT k.nama_kelas 
                                        FROM kelas_user ku 
                                        LEFT JOIN kelas k ON ku.kode_kelas = k.kode_kelas 
                                        WHERE ku.id_user = '$id_user'");

    // Ambil data kelas
    $kelas = mysqli_fetch_assoc($kelas_siswa)['nama_kelas'];
}

$kelassiswa = mysqli_query($conn, "SELECT nama_kelas FROM kelas");

?>

<!-- Content body start -->
<div class="content-body">
    <div class="container">
        <form method="POST" action="proses.php" enctype="multipart/form-data">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-header mb-4">
                            <h4 class="card-title">Edit Data Siswa</h4>
                        </div>
                        <div class="card-body">
                            <input type="hidden" value="<?php echo $id_user; ?>" name="id_user">
                            <div class="form-group row">
                                <label for="namasiswa" class="col-sm-3 col-form-label">Nama Siswa</label>
                                <div class="col-sm-9">
                                    <input required name="nama_siswa" class="form-control" id="namasiswa" placeholder="Masukkan Nama Siswa" value="<?php echo $nama_lengkap; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="emailsiswa" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input required name="email_siswa" class="form-control" id="emailsiswa" placeholder="Masukkan Email Siswa" value="<?php echo $email; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jkel" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <select required id="jkel" name="jenis_kelamin" class="form-control">
                                        <option <?php if($jenis_kelamin == 'Laki-Laki'){echo "selected";} ?> value="Laki-Laki">Laki-Laki</option>
                                        <option <?php if($jenis_kelamin == 'Perempuan'){echo "selected";} ?> value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="teleponsiswa" class="col-sm-3 col-form-label">Telepon</label>
                                <div class="col-sm-9">
                                    <input required name="telepon_siswa" class="form-control" id="teleponsiswa" placeholder="Masukkan No Telepon" value="<?php echo $telepon; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tanggallahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="tanggallahir" name="tanggal_lahir" placeholder="Pilih Tanggal Lahir" value="<?php echo $tanggal_lahir; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kelassiswa" class="col-sm-3 col-form-label">Kelas</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="kelas" id="kelassiswa" required>
                                        <option value="">--Pilih Kelas--</option>
                                        <?php
                                        // Menampilkan daftar kelas untuk pilihan dropdown
                                        while ($r = mysqli_fetch_array($kelassiswa)) :
                                        ?>
                                        <option value="<?= $r['nama_kelas'] ?>" <?php if ($r['nama_kelas'] == $kelas) echo "selected"; ?>><?= $r['nama_kelas'] ?></option>
                                        <?php
                                        endwhile;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ortu" class="col-sm-3 col-form-label">Nama Ortu/Wali</label>
                                <div class="col-sm-9">
                                    <input required name="ortu_wali" class="form-control" id="ortu" placeholder="Masukkan Nama Ortu/Wali" value="<?php echo $ortu; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamatguru" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <textarea required class="form-control" name="alamat_siswa" id="alamatguru" rows="3" placeholder="Masukkan Alamat"><?php echo $alamat; ?></textarea>
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
                                } else {
                            ?>
                                <button type="submit" name="aksi" value="add" class="btn btn-success btn-sm">
                                    <i class="fa fa-floppy-o"></i> Simpan
                                </button>
                            <?php
                                }
                            ?>
                            <a href="ManajemenAkun-Siswa.php" type="button" class="btn btn-danger btn-sm">
                                <i class="fa fa-reply"></i> Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Content body end -->

<?php
require_once '../../layout/footer.php';
?>
