<?php
require_once '../../layout/top.php';
require_once '../../helper/config.php';

$id_user = $_SESSION['user_session'];

$query = "SELECT * FROM user WHERE id_user = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();

if ($user_data) {
    $username = $user_data['username'];
    $nama_guru = $user_data['nama_lengkap'];
    $email_guru = $user_data['email'];
    $jenis_kelamin = $user_data['jenis_kelamin'];
    $foto_guru = $user_data['foto_guru'];
    $telepon_guru = $user_data['telepon'];
    $alamat_guru = $user_data['alamat'];
} else {
    echo "User tidak ditemukan";
}

// Handle form submission to update profile
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['aksi']) && $_POST['aksi'] == 'edit') {
    $nama_guru = $_POST['nama_guru'];
    $email_guru = $_POST['email_guru'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telepon_guru = $_POST['telepon_guru'];
    $alamat_guru = $_POST['alamat_guru'];
    $foto_guru_new = $_FILES['foto_guru'];

    // Check if new photo is uploaded
    if ($foto_guru_new['name'] != '') {
        $target_dir = "../../../assets2/img/foto_guru/";
        $target_file = $target_dir . basename($foto_guru_new["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validate if it's an image
        if (getimagesize($foto_guru_new["tmp_name"]) === false) {
            echo "File is not an image.";
        } else {
            // Check file size (max 5MB)
            if ($foto_guru_new["size"] > 5000000) {
                echo "Sorry, your file is too large.";
            } else {
                // Allow only certain file formats (e.g., jpg, jpeg, png)
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
                } else {
                    // Delete old photo if new photo is uploaded
                    if ($foto_guru != "" && file_exists($target_dir . $foto_guru)) {
                        unlink($target_dir . $foto_guru); // Delete old photo from the directory
                    }

                    // Move uploaded file to target directory
                    if (move_uploaded_file($foto_guru_new["tmp_name"], $target_file)) {
                        // Update photo in database
                        $foto_guru = basename($foto_guru_new["name"]);
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }
    }

    // Update profile data in the database
    $update_query = "UPDATE user SET nama_lengkap = ?, email = ?, jenis_kelamin = ?, foto_guru = ?, telepon = ?, alamat = ? WHERE id_user = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssssssi", $nama_guru, $email_guru, $jenis_kelamin, $foto_guru, $telepon_guru, $alamat_guru, $id_user);

    if ($update_stmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile.";
    }
}
?>

<!-- Menampilkan data profil -->
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
                                    <img src="../../../assets2/img/foto_guru/<?php echo $foto_guru; ?>" 
                                         class="rounded-circle profile-photo mb-3" 
                                         alt="Foto Profil" 
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                    <h4 class="text-primary"><?php echo htmlspecialchars($username); ?></h4>
                                </div>
                            </div>
                        </div>
                        <!-- Form untuk edit profil -->
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" value="<?php echo $id_user; ?>" name="id_user">
                            <div class="form-group row">
                                <label for="namaguru" class="col-sm-3 col-form-label">Nama Guru</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_guru" class="form-control" id="namaguru" value="<?php echo $nama_guru; ?>" placeholder="Masukan Nama Guru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="emailguru" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email_guru" class="form-control" id="emailguru" value="<?php echo $email_guru; ?>" placeholder="Masukan Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jkel" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <select required id="jkel" name="jenis_kelamin" class="form-control">
                                        <option value="Laki-Laki" <?php echo ($jenis_kelamin == 'Laki-Laki') ? 'selected' : ''; ?>>Laki-Laki</option>
                                        <option value="Perempuan" <?php echo ($jenis_kelamin == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fotoguru" class="col-sm-3 col-form-label">Foto Profil</label>
                                <div class="col-sm-9">
                                    <input type="file" name="foto_guru" class="form-control-file" id="fotoguru" accept="image/*">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="teleponguru" class="col-sm-3 col-form-label">Telepon</label>
                                <div class="col-sm-9">
                                    <input type="text" name="telepon_guru" class="form-control" id="teleponguru" value="<?php echo $telepon_guru; ?>" placeholder="Masukkan No Telepon">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamatguru" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat_guru" class="form-control" id="alamatguru" rows="3" placeholder="Masukkan Alamat"><?php echo $alamat_guru; ?></textarea>
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

<?php
require_once '../../layout/footer.php';
?>
