<?php
require_once '../../layout/top.php';
require_once '../../helper/config.php';

$id_jadwal = '';
$hari = '';
$tanggal = '';
$tempat = '';
$nama_kelas = '';
$mapel = '';    
$jam_mulai = '';
$jam_selesai = '';
$nama_guru = '';
$kelasjadwal = mysqli_query($conn, "SELECT nama_kelas FROM kelas");
$gurukelas = mysqli_query($conn, "SELECT nama_lengkap FROM user WHERE role = 'guru'");
$nama_mapel = mysqli_query($conn, "SELECT nama_mapel FROM mapel");

// Mengecek apakah ada parameter 'ubah' di URL
if (isset($_GET['ubah'])) {
    $id_jadwal = $_GET['ubah'];

    $query = "
        SELECT 
            jadwal.*, 
            kelas.nama_kelas, 
            mapel.nama_mapel, 
            user.nama_lengkap 
        FROM 
            jadwal
        JOIN 
            kelas ON jadwal.kode_kelas = kelas.kode_kelas
        JOIN 
            mapel ON jadwal.kode_mapel = mapel.kode_mapel
        JOIN 
            user ON jadwal.id_user = user.id_user
        WHERE 
            jadwal.id_jadwal = '$id_jadwal'
    ";
    $sql = mysqli_query($conn, $query);
    
    // Cek apakah data ditemukan
    if (mysqli_num_rows($sql) > 0) {
        $result = mysqli_fetch_assoc($sql);
        
        // Ambil data dari database
        $hari = $result['hari'];
        $tanggal = $result['tanggal'];
        $tempat = $result['tempat'];
        $nama_kelas = $result['nama_kelas'];
        $mapel = $result['nama_mapel'];
        $jam_mulai = $result['jam_mulai'];
        $jam_selesai = $result['jam_selesai'];
        $nama_guru = $result['nama_lengkap']; // Nama guru diambil dari tabel user
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
}

if (isset($_GET['error']) && $_GET['error'] == 'jam') {
    echo "<script>
        Swal.fire({
            title: 'Gagal!',
            text: 'Jam mulai dan jam selesai tidak boleh sama!',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    </script>";
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
                            <h4 class="card-title">Tambah Jadwal Mengajar</h4>
                        </div>
                        <div class="card-body">
                            <input type="hidden" value="<?php echo $id_jadwal; ?>" name="id_jadwal">
                            <div class="form-group row">
                                <label for="hari" class="col-sm-3 col-form-label">Hari</label>
                                <div class="col-sm-9">
                                    <select id="hari" name="hari" class="form-control">
                                        <option value="" disabled>Pilih Hari</option>
                                        <option value="Senin" <?php echo ($hari == 'Senin') ? 'selected' : ''; ?>>Senin</option>
                                        <option value="Selasa" <?php echo ($hari == 'Selasa') ? 'selected' : ''; ?>>Selasa</option>
                                        <option value="Rabu" <?php echo ($hari == 'Rabu') ? 'selected' : ''; ?>>Rabu</option>
                                        <option value="Kamis" <?php echo ($hari == 'Kamis') ? 'selected' : ''; ?>>Kamis</option>
                                        <option value="Jumat" <?php echo ($hari == 'Jumat') ? 'selected' : ''; ?>>Jumat</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input required type="date" name="tanggal" class="form-control" id="tanggal" value="<?php echo $tanggal; ?>" min="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="tempat" class="col-sm-3 col-form-label">Tempat</label>
                                <div class="col-sm-9">
                                    <input required type ="text" name="tempat" class="form-control" id="tempat" placeholder="Masukkan Tempat" value="<?php echo $tempat;?>">
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="kelassiswa" class="col-sm-3 col-form-label">Kelas</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="nama_kelas" id="kelassiswa" required>
                                        <option value="">--Pilih Kelas--</option>
                                        <?php
                                        while ($r = mysqli_fetch_array($kelasjadwal)) :
                                            $selected = ($r['nama_kelas'] == $nama_kelas) ? 'selected' : '';
                                        ?>
                                        <option value="<?= $r['nama_kelas'] ?>" <?= $selected ?>><?= $r['nama_kelas'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_mapel" class="col-sm-3 col-form-label">Mata Pelajaran</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="mapel" id="nama_mapel" required>
                                        <option value="">--Pilih Mata Pelajaran--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jamMulai" class="col-sm-3 col-form-label">Jam Mulai</label>
                                <div class="col-sm-9">
                                    <input type="time" name="jam_mulai" class="form-control" id="jamMulai" value="<?php echo $jam_mulai;?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jamSelesai" class="col-sm-3 col-form-label">Jam Selesai</label>
                                <div class="col-sm-9">
                                    <input type="time" name="jam_selesai" class="form-control" id="jamSelesai" value="<?php echo $jam_selesai;?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="gurukelas" class="col-sm-3 col-form-label">Nama Guru</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="gurukelas" id="nama_guru" required>
                                        <option value="">--Pilih Nama Guru--</option>
                                        <?php while ($r = mysqli_fetch_array($gurukelas)) : ?>
                                            <option value="<?= $r['nama_lengkap'] ?>" <?= ($r['nama_lengkap'] == $nama_guru) ? 'selected' : '' ?>><?= $r['nama_lengkap'] ?></option>
                                        <?php endwhile; ?>
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
                            <a href="Jadwal.php" type="button" class="btn btn-danger btn-sm">
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
<script>
    document.getElementById('kelassiswa').addEventListener('change', function () {
        const kelas = this.value;

        // Periksa apakah kelas dipilih
        if (kelas) {
            fetch(`get_mapel.php?kelas=${kelas}`)
                .then(response => response.json())
                .then(data => {
                    const mapelDropdown = document.getElementById('nama_mapel');
                    mapelDropdown.innerHTML = '<option value="">--Pilih Mata Pelajaran--</option>';

                    // Periksa apakah data array valid dan sesuai format
                    if (Array.isArray(data) && data.length > 0) {
                        data.forEach(mapel => {
                            const option = document.createElement('option');
                            option.value = mapel.kode_mapel; // Set kode_mapel sebagai value
                            option.textContent = mapel.nama_mapel; // Set nama_mapel sebagai text
                            mapelDropdown.appendChild(option);
                        });
                    } else {
                        console.error('Data tidak sesuai atau tidak ada mata pelajaran untuk kelas ini');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>
<?php
require_once '../../layout/footer.php';
?>
