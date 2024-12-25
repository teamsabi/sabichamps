<?php
require_once '../../layout/top.php';
require_once '../../helper/config.php';

$id_user = '';
$nama_lengkap = '';
$email = '';
$jenis_kelamin = '';
$telepon = '';
$alamat = '';

if(isset($_GET['ubah'])){
        $id_user = $_GET['ubah'];

        $query = "SELECT * FROM user WHERE id_user= '$id_user';";
        $sql = mysqli_query($conn, $query);

        $result = mysqli_fetch_assoc($sql);

        $nama_lengkap = $result['nama_lengkap'];
        $email = $result['email'];
        $jenis_kelamin = $result['jenis_kelamin'];
        $telepon = $result['telepon'];
        $alamat = $result['alamat'];
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
                                                                <h4 class="card-title">Tambah Data Guru</h4>
                                                        </div>
                                                        <div class="card-body">
                                                                <input type="hidden" value="<?php echo $id_user; ?>" name="id_user">
                                                                <div class="form-group row">
                                                                        <label for="namaguru" class="col-sm-3 col-form-label">Nama Guru</label>
                                                                        <div class="col-sm-9">
                                                                                <input required ="text" name = "nama_guru" class="form-control" id="namaguru" placeholder="Masukkan Nama Guru" value="<?php echo $nama_lengkap; ?>">
                                                                        </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                        <label for="emailguru" class="col-sm-3 col-form-label">Email</label>
                                                                        <div class="col-sm-9">
                                                                                <input required type="email" name="email_guru" class="form-control" id="emailguru" placeholder="Masukkan Email" value="<?php echo $email; ?>">
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
                                                                        <label for="fotoguru" class="col-sm-3 col-form-label">Foto Profil</label>
                                                                        <div class="col-sm-9">
                                                                                <input <?php if(!isset($_GET['ubah'])){ echo "required";} ?> type="file" name="foto_guru" class="form-control-file" id="fotoguru" accept="image/*">
                                                                        </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                        <label for="teleponguru" class="col-sm-3 col-form-label">Telepon</label>
                                                                        <div class="col-sm-9">
                                                                                <input required ="text" name="telepon_guru" class="form-control" id="teleponguru" placeholder="Masukkan No Telepon" value="<?php echo $telepon; ?>">
                                                                        </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                        <label for="alamatguru" class="col-sm-3 col-form-label">Alamat</label>
                                                                        <div class="col-sm-9">
                                                                                <textarea required class="form-control" name="alamat_guru" id="alamatguru" rows="3" placeholder="Masukkan Alamat"><?php echo $alamat; ?></textarea>
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
                                                                <a href="ManajemenAkun-Guru.php" type="button" class="btn btn-danger btn-sm">
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