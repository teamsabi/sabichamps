<?php
require_once '../../layout/top.php';
 ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Data Siswa</h4>
                            </div>

                            <!-- Button Tambah Akun -->
                            <div class="row mb-3">
                                <div class="col-lg-8 col-12" style="margin-top: -30px; margin-left: 120px;">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#addAkunGuru">
                                        <i class="fa fa-plus"></i> Tambah Data Siswa
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="guruTable" class="display" style="width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Siswa</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Alamat</th>
                                            <th>Telepon</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Kelas</th>
                                            <th>Orang Tua/Wali</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Siswa</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Alamat</th>
                                            <th>Telepon</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Kelas</th>
                                            <th>Orang Tua/Wali</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                    $(document).ready(function () {
                        var table = $('#guruTable').DataTable();
                    });
                    </script>
                </div>
            </div>

        </div>
        <!--Content body end-->

<?php
require_once '../../layout/footer.php';
?>