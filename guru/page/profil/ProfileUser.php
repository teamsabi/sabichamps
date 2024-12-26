<?php
require_once '../../layout/top.php';
require_once '../../helper/conek.php';

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
                    <div class="card-body">
                        <div class="container">
                            <div class="row justify-content-center mt-5">
                                <div class="photo-content">
                                    <img src="../../images/foto_guru/Nadifatus Aulia E." 
                                         class="rounded-circle profile-photo mb-3" 
                                         alt="Foto Profil" 
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                    <h4 class="text-primary"><?php echo htmlspecialchars($username); ?></h4>
                                </div>
                            </div>
                        </div>
                        <!-- Form -->
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" value="<?php echo $kode_guru; ?>" name="kode_guru">
                            <div class="form-group row">
                                <label for="namaguru" class="col-sm-3 col-form-label">Nama Guru</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_guru" class="form-control" id="namaguru" placeholder="Masukan Nama Guru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="emailguru" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email_guru" class="form-control" id="emailguru" placeholder="Masukan Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jkel" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <select required id="jkel" name="jenis_kelamin" class="form-control">
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
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
                                    <input type="text" name="telepon_guru" class="form-control" id="teleponguru" placeholder="Masukkan No Telepon">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamatguru" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat_guru" class="form-control" id="alamatguru" rows="3" placeholder="Masukkan Alamat"></textarea>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" name="aksi" value="edit" class="btn btn-success btn-sm">
                                    <i class="fa fa-floppy-o"></i> Simpan Perubahan
                                </button>
                                <a href="../dashboard/index.php" type="button" class="btn btn-danger btn-sm">
                                    <i class="fa fa-reply"></i> Kembali
                                </a>
                            </div>
                        </form>
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