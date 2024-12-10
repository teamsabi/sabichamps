<?php
require_once '../../layout/top.php';
require_once '../../helper/conek.php';

$kode_guru = '';
$nama_guru = '';
$email = '';
$jenis_kelamin = '';
$telepon = '';
$alamat = '';

if (isset($_GET['ubah'])) {
    $kode_guru = $_GET['ubah'];

    $query = "SELECT * FROM guru WHERE kode_guru = '$kode_guru';";
    $sql = mysqli_query($conn, $query);

    if ($sql) {
        $result = mysqli_fetch_assoc($sql);
        $nama_guru = $result['nama_guru'];
        $email = $result['email'];
        $jenis_kelamin = $result['jenis_kelamin'];
        $telepon = $result['telepon'];
        $alamat = $result['alamat'];
        $foto = $result['foto_guru']; // Ambil path foto dari database
    }
}

?>

<!--Content body start-->
<div class="content-body">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Profil</h4>
                    </div>
                    <body>
                    <div class="container">
                        <div class="row justify-content-center mt-5">
                            <div class="col-auto text-center">
                            <div class="photo-content">
                            <div class="profile-photo-container">
                                <img src="images/profile/default.png" class="rounded-circle profile-photo" alt="Foto Profil">
                                <p class="mt-2">
                                    <a href="#" class="text-primary edit-photo-link">Edit Foto Profil</a>
                                </p>
                                <p class="text-muted">Ukuran gambar maksimal 5 MB</p>
                            </div>
                            <div class="mt-3">
                                <h4 class="text-primary"><?php echo htmlspecialchars($username); ?></h4>
                                <p class="text-muted"><?php echo htmlspecialchars($email); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                    <!--Form-->
                    <div class="card-body">
                        <input type="hidden" value="<?php echo $kode_guru; ?>" name="kode_guru">
                        <div class="form-group row">
                            <label for="namaguru" class="col-sm-3 col-form-label">Nama Guru</label>
                            <div class="col-sm-9">
                                <input type ="text" name = "nama_guru" class="form-control" id="namaguru" value="<?php echo $nama_guru; ?>">
                            </div>
                        </div>
                       <div class="form-group row">
                            <label for="emailguru" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email_guru" class="form-control" id="emailguru" value="<?php echo $email; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jkel" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <select required id="jkel" name="jenis_kelamin" class="form-control">
                                <!-- <option selected>--Pilih Jenis Kelamin--</option> -->
                                <option <?php if($jenis_kelamin == 'Laki-Laki'){echo "selected";} ?> value="Laki-Laki">Laki-Laki</option>
                                <option <?php if($jenis_kelamin == 'Perempuan'){echo "selected";} ?> value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="teleponguru" class="col-sm-3 col-form-label">Telepon</label>
                            <div class="col-sm-9">
                                <input type ="text" name="telepon_guru" class="form-control" id="teleponguru" placeholder="Masukkan No Telepon" value="<?php echo $telepon; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamatguru" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea name="alamat_guru" class="form-control" id="alamatguru" rows="3" placeholder="Masukkan Alamat"><?php echo $alamat; ?></textarea>
                           </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <?php if(isset($_GET['ubah'])){  ?>
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
                        <a href="../dashboard/index.php" type="button" class="btn btn-danger btn-sm">
                            <i class="fa fa-reply"></i> Batal
                        </a>
                    </div>               
                </div>
            </div>
        </div>
    </div>
</div>

<!--Content body end-->

<?php
require_once '../../layout/footer.php';
?>