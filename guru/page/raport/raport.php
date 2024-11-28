<?php
require_once '../../layout/top.php';
?>

<!-- Table Raport Siswa -->
<div class="col-lg-12" style="margin-top: -30px;">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Raport Siswa</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="display" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <!-- Isi tabel akan diambil dari database -->
                        <?php
                        // Contoh koneksi database dan fetch data
                        $conn = new mysqli("localhost", "username", "password", "database");
                        if ($conn->connect_error) {
                            die("Koneksi gagal: " . $conn->connect_error);
                        }

                        $sql = "SELECT * FROM jadwal_mengajar";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$no}</td>
                                        <td>{$row['hari']}</td>
                                        <td>{$row['nama_kelas']}</td>
                                        <td>{$row['mata_pelajaran']}</td>
                                        <td>{$row['waktu_mulai']}</td>
                                        <td>{$row['waktu_selesai']}</td>
                                        <td>{$row['nama_guru']}</td>
                                      </tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td colspan='7'>Data tidak tersedia</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
