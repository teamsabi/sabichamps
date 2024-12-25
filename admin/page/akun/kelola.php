<?php
require_once '../../layout/top.php';
require_once '../../helper/config.php';

$id_user = '';
$username = '';
$email = '';
$password = '';    
$role = '';

// Mengecek apakah ada parameter 'ubah' di URL
if (isset($_GET['ubah'])) {
    $id_user = $_GET['ubah'];

    // Query untuk mengambil data berdasarkan ID jadwal
    $query = "SELECT * FROM user WHERE id_user = '$id_user'";
    $sql = mysqli_query($conn, $query);
    
    // Cek apakah data ditemukan
    if (mysqli_num_rows($sql) > 0) {
        $result = mysqli_fetch_assoc($sql);
        
        // Ambil data dari database
        $username = $result['username'];
        $email = $result['email'];
        $password = $result['password'];
        $role = $result['role'];
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
                            <h4 class="card-title">Tambah Data User</h4>
                        </div>
                        <div class="card-body">
                            <input type="hidden" value="<?php echo $id_user; ?>" name="id_user">
                            <div class="form-group row">
                                <label for="usernames" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input required="text" name="username" class="form-control" id="usernames" placeholder="Masukkan Username" value="<?php echo $username;?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="emailuser" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input required="text" name="email" class="form-control" id="emailuser" placeholder="Masukkan Email" value="<?php echo $email;?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="passworduser" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input required="text" name="password" class="form-control" id="passworduser" placeholder="Masukkan Password" value="<?php echo $password;?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="roleuser" class="col-sm-3 col-form-label">Role</label>
                                <div class="col-sm-9">
                                    <select required id="roleuser" name="role" class="form-control">
                                        <!-- <option selected>--Pilih Jenis Kelamin--</option> -->
                                        <option <?php if($role == 'admin'){echo "selected";} ?> value="admin">admin</option>
                                        <option <?php if($role == 'guru'){echo "selected";} ?> value="guru">guru</option>
                                        <option <?php if($role == 'siswa'){echo "selected";} ?> value="siswa">siswa</option>
                                    </select>
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
                            <a href="userlogin.php" type="button" class="btn btn-danger btn-sm">
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