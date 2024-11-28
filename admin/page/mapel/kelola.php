<?php
require_once '../../layout/top.php';
require_once '../../helper/conek.php';

$id_mapel = '';
$kode_mapel= '';
$nama_mapel = '';

if(isset($_GET['ubah'])){
    $id_mapel = $_GET['ubah'];

    $query = "SELECT * FROM mapel WHERE id_mapel = '$id_mapel';";
    $sql = mysqli_query($conn, $query);

    $result = mysqli_fetch_assoc($sql);

    $kode_mapel = $result['kode_mapel'];
    $nama_mapel = $result['nama_mapel'];
} else {
    // Generate kode kelas secara otomatis
    $query = "SELECT kode_mapel FROM mapel ORDER BY id_mapel DESC LIMIT 1;";
    $sql = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($sql);

    if ($result) {
        $last_number = intval(substr($result['kode_mapel'], 3));
        $next_number = $last_number + 1;
    } else {
        $next_number = 1;
    }

    $kode_mapel = 'MPL' . str_pad($next_number, 3, '0', STR_PAD_LEFT);
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
                                                                <h4 class="card-title">Tambah Data Kelas</h4>
                                                        </div>
                                                        <div class="card-body">
                                                                <input type="hidden" value="<?php echo $id_mapel; ?>" name="id_mapel">
                                                                <div class="form-group row">
                                                                    <label for="kodemapel" class="col-sm-3 col-form-label">Kode Mapel</label>
                                                                    <div class="col-sm-9">
                                                                        <input required type="text" name="kode_mapel" class="form-control" id="kodemapel" value="<?php echo $kode_mapel; ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                        <label for="namamapel" class="col-sm-3 col-form-label">Nama Mapel</label>
                                                                        <div class="col-sm-9">
                                                                                <input required type="text" name="nama_mapel" class="form-control" id="namamapel" placeholder="Masukkan Nama Mapel" value="<?php echo $nama_mapel; ?>">
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
                                                                <a href="Mapel.php" type="button" class="btn btn-danger btn-sm">
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