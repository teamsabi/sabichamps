<?php
    require_once '../../layout/top.php';
    require_once '../../helper/conek.php';

 ?>

        <!--Content body start-->
        <div class="content-body">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Data Guru</h4>
                            </div>

                            <!-- Button Tambah Akun
                            <div class="row mb-3">
                                <div class="col-lg-8 col-12" style="margin-top: -30px; margin-left: 110px;">
                                    <a href="kelola.php" class="btn btn-success">
                                        <i class="fa fa-plus"></i> Tambah Data Guru
                                    </a>
                                </div>
                            </div> -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="guruTable" class="display table-hover" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama Guru</th>
                                                <th>Email</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Foto Profil</th>
                                                <th>Telepon</th>
                                                <th>Alamat</th>
                                                <th>Tanggal Buat</th>
                                                <th style="width: 200">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Nama Guru</td>
                                                <td>Nama Guru</td>
                                                <td>Nama Guru</td>
                                                <td>Nama Guru</td>
                                                <td>Nama Guru</td>
                                                <td>Nama Guru</td>
                                                <td>Nama Guru</td>
                                                <td>Nama Guru</td>
                                                <td>Nama Guru</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama Guru</th>
                                                <th>Email</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Foto Profil</th>
                                                <th>Telepon</th>
                                                <th>Alamat</th>
                                                <th>Tanggal Buat</th>
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