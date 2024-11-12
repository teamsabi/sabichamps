<?php
require_once '../../layout/top.php';
 ?>

        <!--Content body start-->
        <div class="content-body">
                <div class="container">
                        <form method="POST" action="proses.php">
                                <div class="row justify-content-center">
                                        <div class="col-md-11">
                                                <div class="card">
                                                        <div class="card-header mb-4">
                                                                <h4 class="card-title">Tambah Data Guru</h4>
                                                        </div>
                                                        <div class="card-body">
                                                                <div class="form-group row">
                                                                        <label for="namaguru" class="col-sm-3 col-form-label">Nama Guru</label>
                                                                        <div class="col-sm-9">
                                                                                <input type="text" class="form-control" id="namaguru" placeholder="Masukkan Nama Guru">
                                                                        </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                        <label for="emailguru" class="col-sm-3 col-form-label">Email</label>
                                                                        <div class="col-sm-9">
                                                                                <input type="email" class="form-control" id="emailguru" placeholder="Masukkan Email">
                                                                        </div>
                                                                </div>
                                                                <!-- <div class="form-group row">
                                                                        <label for="passwordguru" class="col-sm-3 col-form-label">Password</label>
                                                                        <div class="col-sm-9">
                                                                                <div class="input-group">
                                                                                        <input type="password" class="form-control" id="passwordguru" placeholder="Masukkan Password">
                                                                                        <div class="input-group-append">
                                                                                                <span class="input-group-text password-toggle" onclick="togglePassword()">
                                                                                                        <i class="fa fa-eye" id="toggleIcon"></i>
                                                                                                </span>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                </div> -->
                                                                <div class="form-group row">
                                                                        <label for="jkel" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                                                        <div class="col-sm-9">
                                                                                <select id="jkel" class="form-control">
                                                                                <option selected>Jenis Kelamin</option>
                                                                                <option value="Laki-Laki">Laki-Laki</option>
                                                                                <option value="Perempuan">Perempuan</option>
                                                                                </select>
                                                                        </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                        <label for="fotoguru" class="col-sm-3 col-form-label">Foto Profil</label>
                                                                        <div class="col-sm-9">
                                                                                <input type="file" class="form-control-file" id="fotoguru">
                                                                        </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                        <label for="teleponguru" class="col-sm-3 col-form-label">Telepon</label>
                                                                        <div class="col-sm-9">
                                                                                <input type="text" class="form-control" id="teleponguru" placeholder="Masukkan No Telepon">
                                                                        </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                        <label for="alamatguru" class="col-sm-3 col-form-label">Alamat</label>
                                                                        <div class="col-sm-9">
                                                                                <textarea class="form-control" id="alamatguru" rows="3" placeholder="Masukkan Alamat"></textarea>
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

        <!-- <script>
        function togglePassword() {     
                const passwordInput = document.getElementById("passwordguru");
                const toggleIcon = document.getElementById("toggleIcon");
                
                if (passwordInput.type === "password") {
                        passwordInput.type = "text";
                        toggleIcon.classList.remove("fa-eye");
                        toggleIcon.classList.add("fa-eye-slash");
                } else {
                        passwordInput.type = "password";
                        toggleIcon.classList.remove("fa-eye-slash");
                        toggleIcon.classList.add("fa-eye");
                }
        }
        </script> -->

        <!--Content body end-->



<?php
require_once '../../layout/footer.php';
?>