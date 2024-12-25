<?php
require_once '../../layout/top.php';
require_once '../../helper/config.php';

$kode_mapel = '';
$nama_mapel = '';
$nama_kelas = '';

if (isset($_GET['ubah'])) {
    $kode_mapel = $_GET['ubah'];

    $query = "
        SELECT mapel.*, kelas.nama_kelas 
        FROM mapel 
        JOIN kelas ON mapel.kode_kelas = kelas.kode_kelas 
        WHERE mapel.kode_mapel = '$kode_mapel';
    ";
    $sql = mysqli_query($conn, $query);

    $result = mysqli_fetch_assoc($sql);

    $nama_mapel = $result['nama_mapel'];
    $nama_kelas = $result['nama_kelas'];
} else {
    // Generate kode mapel secara otomatis
    $query = "SELECT kode_mapel FROM mapel ORDER BY kode_mapel DESC LIMIT 1;";
    $sql = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($sql);

    if ($result) {
        // Ambil angka terakhir dari kode mapel, lalu tambahkan 1
        $last_number = intval(substr($result['kode_mapel'], 2)); // Ambil bagian angka setelah 'MP'
        $next_number = $last_number + 1;
    } else {
        $next_number = 1; // Jika belum ada data, mulai dari 1
    }

    // Format kode mapel dengan prefix 'MP' dan angka 3 digit
    $kode_mapel = 'MP' . str_pad($next_number, 3, '0', STR_PAD_LEFT);
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
                            <h4 class="card-title">
                                <?php echo isset($_GET['ubah']) ? "Edit Data Mapel" : "Tambah Data Mapel"; ?>
                            </h4>
                        </div>
                        <div class="card-body">
                            <input type="hidden" value="<?php echo $id_mapel; ?>" name="id_mapel">

                            <!-- Kode Mapel -->
                            <div class="form-group row">
                                <label for="kodemapel" class="col-sm-3 col-form-label">Kode Mapel</label>
                                <div class="col-sm-9">
                                    <input required type="text" name="kode_mapel" class="form-control" id="kodemapel"
                                           value="<?php echo $kode_mapel; ?>" readonly>
                                </div>
                            </div>

                            <!-- Nama Mapel -->
                            <div class="form-group row">
                                <label for="namamapel" class="col-sm-3 col-form-label">Nama Mapel</label>
                                <div class="col-sm-9">
                                    <input required type="text" name="nama_mapel" class="form-control" id="namamapel"
                                           placeholder="Masukkan Nama Mapel" value="<?php echo $nama_mapel; ?>">
                                </div>
                            </div>

                            <!-- Nama Kelas (Dropdown) -->
                            <div class="form-group row">
                                <label for="namakelas" class="col-sm-3 col-form-label">Nama Kelas</label>
                                <div class="col-sm-9">
                                    <select name="nama_kelas" id="namakelas" class="form-control" required>
                                        <option value="">-- Pilih Nama Kelas --</option>
                                        <?php
                                        // Ambil daftar nama_kelas dari tabel kelas
                                        $query_kelas = "SELECT kode_kelas, nama_kelas FROM kelas";
                                        $result_kelas = mysqli_query($conn, $query_kelas);
                                        while ($row_kelas = mysqli_fetch_assoc($result_kelas)) {
                                            $selected = (isset($nama_kelas) && $nama_kelas == $row_kelas['nama_kelas']) ? "selected" : "";
                                            echo "<option value='{$row_kelas['kode_kelas']}' $selected>{$row_kelas['nama_kelas']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <?php if (isset($_GET['ubah'])) { ?>
                                <button type="submit" name="aksi" value="edit" class="btn btn-success btn-sm">
                                    <i class="fa fa-floppy-o"></i> Simpan Perubahan
                                </button>
                            <?php } else { ?>
                                <button type="submit" name="aksi" value="add" class="btn btn-success btn-sm">
                                    <i class="fa fa-floppy-o"></i> Simpan
                                </button>
                            <?php } ?>
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
