<?php
require_once '../../layout/top.php';
require_once '../../helper/config.php';

    $today = date('Y-m-d');

    $queryJadwal = "SELECT 
        j.id_jadwal,
        k.nama_kelas,
        m.nama_mapel,
        u.nama_lengkap,
        j.hari,
        j.tanggal,
        j.tempat,
        j.jam_mulai,
        j.jam_selesai
    FROM 
        jadwal j
    JOIN 
        kelas k ON j.kode_kelas = k.kode_kelas
    JOIN 
        mapel m ON j.kode_mapel = m.kode_mapel
    JOIN 
        user u ON j.id_user = u.id_user
    WHERE 
        j.tanggal = '$today'";
    $resultJadwal = $conn->query($queryJadwal);

    // Query untuk menghitung jumlah data
    $queryGuru = "SELECT COUNT(*) AS jumlah_guru FROM user WHERE role = 'guru'";
    $querySiswa = "SELECT COUNT(*) AS jumlah_siswa FROM user WHERE role = 'siswa'";
    $queryKelas = "SELECT COUNT(*) AS jumlah_kelas FROM kelas";

    // Eksekusi query
    $resultGuru = $conn->query($queryGuru);
    $resultSiswa = $conn->query($querySiswa);
    $resultKelas = $conn->query($queryKelas);

    // Ambil hasil
    $jumlahGuru = $resultGuru->fetch_assoc()['jumlah_guru'];
    $jumlahSiswa = $resultSiswa->fetch_assoc()['jumlah_siswa'];
    $jumlahKelas = $resultKelas->fetch_assoc()['jumlah_kelas'];


?>

        <!--Content body start-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hai, <?php echo htmlspecialchars($username); ?>!</h4>
                            <p class="mb-0">Admin</p>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        </ol>
                    </div>
                </div>
            
                <div class="container">
                    <!-- Jumlah Guru, Siswa, Kelas -->
                    <div class="row mb-3">
                        <div class="col-lg-4 col-sm-6">
                            <div class="card">
                                <div class="stat-widget-one card-body">
                                    <div class="stat-icon d-inline-block">
                                        <i class="ti-user text-success border-success"></i>
                                    </div>
                                    <div class="stat-content d-inline-block">
                                        <div class="stat-text">Guru</div>
                                        <div class="stat-digit"><?php echo $jumlahGuru; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="card">
                                <div class="stat-widget-one card-body">
                                    <div class="stat-icon d-inline-block">
                                        <i class="ti-book text-primary border-primary"></i>
                                    </div>
                                    <div class="stat-content d-inline-block">
                                        <div class="stat-text">Siswa</div>
                                        <div class="stat-digit"><?php echo $jumlahSiswa; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="card">
                                <div class="stat-widget-one card-body">
                                    <div class="stat-icon d-inline-block">
                                        <i class="ti-clipboard text-pink border-pink"></i>
                                    </div>
                                    <div class="stat-content d-inline-block">
                                        <div class="stat-text">Kelas</div>
                                        <div class="stat-digit"><?php echo $jumlahKelas; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table Jadwal Mengajar and Siswa Ter-Ambis -->
                    <div class="row mb-3">
                        <!-- Table Jadwal Mengajar -->
                        <div class="col-lg-12" style="margin-top: -30px;">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Jadwal Hari Ini</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example" class="display" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Hari</th>
                                                    <th>Tanggal</th>
                                                    <th>Mata Pelajaran</th>
                                                    <th>Tempat</th>
                                                    <th>Nama Kelas</th>
                                                    <th>Jam Mulai</th>
                                                    <th>Jam Selesai</th>
                                                    <th>Nama Guru</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Hari</th>
                                                    <th>Tanggal</th>
                                                    <th>Mata Pelajaran</th>
                                                    <th>Tempat</th>
                                                    <th>Nama Kelas</th>
                                                    <th>Jam Mulai</th>
                                                    <th>Jam Selesai</th>
                                                    <th>Nama Guru</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                $no = 0;
                                                while ($row = $resultJadwal->fetch_assoc()) {
                                                    ?>
                                                    <tr>
                                                    <td><?php echo ++$no; ?>. </td>
                                                    <td><?php echo $row['hari']; ?></td>
                                                    <td><?php echo $row['tanggal']; ?></td>
                                                    <td><?php echo $row['nama_mapel']; ?></td>
                                                    <td><?php echo $row['tempat']; ?></td>
                                                    <td><?php echo $row['nama_kelas']; ?></td>
                                                    <td><?php echo $row['jam_mulai']; ?></td>
                                                    <td><?php echo $row['jam_selesai']; ?></td>
                                                    <td><?php echo $row['nama_lengkap']; ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
