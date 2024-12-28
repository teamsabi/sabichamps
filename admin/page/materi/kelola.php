<?php
require_once '../../layout/top.php';
require_once '../../helper/config.php';

$id_materi = '';
$judul_materi = '';
$nama_mapel = '';
$kode_mapel = ''; // Tambahkan inisialisasi variabel dengan nilai default
$nama_lengkap = '';

// Mengecek apakah ada parameter 'ubah' di URL
if (isset($_GET['ubah'])) {
    $id_materi = $_GET['ubah'];

    // Query untuk mengambil data berdasarkan ID materi
    $query = "
        SELECT 
            materi.id_materi, 
            materi.judul_materi, 
            mapel.nama_mapel, 
            mapel.kode_mapel, 
            user.nama_lengkap
        FROM 
            materi
        JOIN 
            mapel ON materi.kode_mapel = mapel.kode_mapel
        JOIN 
            materi_siswa ON materi.id_materi = materi_siswa.id_materi
        JOIN 
            user ON materi_siswa.id_user = user.id_user
        WHERE 
            materi.id_materi = '$id_materi';
    ";
    $sql = mysqli_query($conn, $query);
    
    // Cek apakah data ditemukan
    if (mysqli_num_rows($sql) > 0) {
        $result = mysqli_fetch_assoc($sql);
        
        // Ambil data dari database
        $id_materi = $result['id_materi'];
        $judul_materi = $result['judul_materi'];
        $nama_mapel = $result['nama_mapel'];
        $kode_mapel = $result['kode_mapel']; // Ambil kode_mapel
        $nama_lengkap = $result['nama_lengkap'];
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
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
                            <h4 class="card-title"><?php echo isset($_GET['ubah']) ? 'Ubah Materi' : 'Tambah Materi'; ?></h4>
                        </div>
                        <div class="card-body">
                            <input type="hidden" value="<?php echo $id_materi; ?>" name="kode_materi">
                            
                            <!-- Input untuk Judul Materi -->
                            <div class="form-group row">
                                <label for="judulmateri" class="col-sm-3 col-form-label">Judul Materi</label>
                                <div class="col-sm-9">
                                    <input required="text" name="judul_materi" class="form-control" id="judulmateri" placeholder="Namakan Judul Materi" value="<?php echo $judul_materi;?>">
                                </div>
                            </div>

                            <!-- Dropdown untuk Mata Pelajaran -->
                            <!-- Dropdown untuk Mata Pelajaran -->
<div class="form-group row">
    <label for="mapel" class="col-sm-3 col-form-label">Mata Pelajaran</label>
    <div class="col-sm-9">
        <select class="form-control" name="mapel" id="mapel" required>
            <option value="">--Pilih Mata Pelajaran--</option>
            <?php
            // Query untuk mengambil daftar mata pelajaran
            $mapel_query = "SELECT kode_mapel, nama_mapel FROM mapel";
            $mapel_result = mysqli_query($conn, $mapel_query);
            while ($r = mysqli_fetch_array($mapel_result)) :
            ?>
            <option value="<?= $r['kode_mapel'] ?>" <?= ($r['kode_mapel'] == $kode_mapel) ? 'selected' : ''; ?>>
                <?= $r['nama_mapel'] . ' (' . $r['kode_mapel'] . ')'; ?>
            </option>
            <?php
            endwhile;
            ?>
        </select>
    </div>
</div>


                            <!-- Input untuk File Materi -->
                            <div class="form-group row">
                                <label for="filemateri" class="col-sm-3 col-form-label">File Materi</label>
                                <div class="col-sm-9">
                                    <input <?php if(!isset($_GET['ubah'])){ echo "required";} ?> type="file" name="file_materi" class="form-control-file" id="filemateri">
                                </div>
                            </div>

                            <!-- Dropdown untuk Nama Guru -->
                            <div class="form-group row">
                                <label for="gurumateri" class="col-sm-3 col-form-label">Nama Guru</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="nama_lengkap" id="gurumateri" required>
                                        <option value="">--Pilih Guru Pengajar--</option>
                                        <?php
                                        // Query untuk mengambil daftar guru
                                        $guru_query = "SELECT * FROM user WHERE role = 'guru'";
                                        $guru_result = mysqli_query($conn, $guru_query);
                                        while ($r = mysqli_fetch_array($guru_result)) :
                                        ?>
                                        <option value="<?= $r['id_user'] ?>" <?= ($r['nama_lengkap'] == $nama_lengkap) ? 'selected' : ''; ?>>
                                            <?= $r['nama_lengkap'] ?>
                                        </option>
                                        <?php
                                        endwhile;
                                        ?>
                                    </select>
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
                            <a href="Materi.php" type="button" class="btn btn-danger btn-sm">
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
