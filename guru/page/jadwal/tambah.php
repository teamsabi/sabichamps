<?php
require_once '../../layout/top.php';
require_once '../../helper/conek.php';

$id_jadwal = '';
$hari = '';
$nama_kelas = '';
$mapel = '';    
$jam_mulai = '';
$jam_selesai = '';
$nama_guru = '';

// Mengecek apakah ada parameter 'ubah' di URL
if (isset($_GET['ubah'])) {
    $id_jadwal = $_GET['ubah'];

    // Query untuk mengambil data berdasarkan ID jadwal
    $query = "SELECT * FROM jadwal WHERE id_jadwal = '$id_jadwal'";
    $sql = mysqli_query($conn, $query);
    
    // Cek apakah data ditemukan
    if (mysqli_num_rows($sql) > 0) {
        $result = mysqli_fetch_assoc($sql);
        
        // Ambil data dari database
        $hari = $result['hari'];
        $nama_kelas = $result['nama_kelas'];
        $mapel = $result['mapel'];
        $jam_mulai = $result['jam_mulai'];
        $jam_selesai = $result['jam_selesai'];
        $nama_guru = $result['nama_guru'];
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
        <input type="hidden" name="id_jadwal" value="<?= $id_jadwal; ?>">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-header mb-4">
                            <h4 class="card-title">Tambah Jadwal Mengajar</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="hari" class="col-sm-3 col-form-label">Hari</label>
                                <div class="col-sm-9">
                                    <select id="hari" name="hari" class="form-control">
                                        <option selected disabled>Pilih Hari</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                        <option value="Minggu">Minggu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="namaKelas" class="col-sm-3 col-form-label">Nama Kelas</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_kelas" class="form-control" id="namaKelas" placeholder="Masukkan Nama Kelas" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mapel" class="col-sm-3 col-form-label">Mata Pelajaran</label>
                                <div class="col-sm-9">
                                    <input type="text" name="mapel" class="form-control" id="mapel" placeholder="Masukkan Mata Pelajaran" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jamMulai" class="col-sm-3 col-form-label">Jam Mulai</label>
                                <div class="col-sm-9">
                                    <input type="time" name="jam_mulai" class="form-control" id="jamMulai" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jamSelesai" class="col-sm-3 col-form-label">Jam Selesai</label>
                                <div class="col-sm-9">
                                    <input type="time" name="jam_selesai" class="form-control" id="jamSelesai" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="namaGuru" class="col-sm-3 col-form-label">Nama Guru</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_guru" class="form-control" id="namaGuru" placeholder="Masukkan Nama Guru" required>
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
                            <a href="jadwal.php" type="button" class="btn btn-danger btn-sm">
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

