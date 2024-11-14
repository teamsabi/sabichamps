<?php
require_once '../../layout/top.php';
require_once '../../helper/conek.php';

if (isset($_GET['kode_kelas'])) {
    $kode_kelas = $_GET['kode_kelas'];
    $query = "SELECT * FROM siswa WHERE kode_kelas = '$kode_kelas'";
    $sql = mysqli_query($conn, $query);
} else {
    echo "Kode kelas tidak ditemukan!";
    exit;
}
?>

<!--Content body start-->
<div class="content-body">
    <div class="container">
        <h4 class="mb-4">Daftar Siswa Kelas <?php echo $kode_kelas; ?></h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Email</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Tanggal Lahir</th>
                    <th>Kelas</th>
                    <th>Orangtua/Wali</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                while ($row = mysqli_fetch_assoc($sql)) { ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($row['nama_siswa']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                        <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                        <td><?php echo htmlspecialchars($row['telepon']); ?></td>
                        <td><?php echo htmlspecialchars($row['tanggal_lahir']); ?></td>
                        <td><?php echo htmlspecialchars($row['kelas']); ?></td>
                        <td><?php echo htmlspecialchars($row['ortu_wali']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!--Content body end-->

<?php
require_once '../../layout/footer.php';
?>
