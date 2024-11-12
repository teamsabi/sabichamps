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
                                <h4 class="card-title">Jadwal Kelas</h4>
                            </div>

                            <!-- Button Tambah Akun -->
                            <div class="row mb-3">
                                <div class="col-lg-8 col-12" style="margin-top: -30px; margin-left: 130px;">
                                    <button class="btn btn-success" style="color: #f1f5f8; background-color: #229799; border-color: #229799;" data-toggle="modal" data-target="#addAkunGuru">
                                        <i class="fa fa-plus"></i> Tambah Jadwal
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="guruTable" class="display" style="width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Hari</th>
                                            <th>Nama Kelas</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Rentang Waktu</th>
                                            <th>Nama Guru</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Hari</th>
                                            <th>Nama Kelas</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Rentang Waktu</th>
                                            <th>Nama Guru</th>
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