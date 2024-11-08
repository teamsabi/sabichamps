<?php require_once '../admin/layout/top.php'?>

        <!-- Nav header start-->
        <?php include "layout/nav-header.html"?>
        <!--Nav header end-->

        <!--Header start-->
        <?php include "layout/header.html"?>
        <!--Header end-->

        <!--Sidebar start-->
        <?php include "layout/sidebar.html"?>
        <!--Sidebar end-->

        <!--Content body start-->
        <div class="content-body">
            <!-- Include DataTables CSS & JS -->
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Data Guru</h4>
                            </div>

                            <!-- Button Tambah Akun -->
                            <div class="row mb-3">
                                <div class="col-lg-8 col-12" style="margin-top: -30px; margin-left: 110px;">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#addAkunGuru">
                                        <i class="fa fa-plus"></i> Tambah Akun Guru
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="guruTable" class="display" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama Guru</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>Alamat</th>
                                                <th>Telepon</th>
                                                <th>Kategori</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama Guru</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>Alamat</th>
                                                <th>Telepon</th>
                                                <th>Kategori</th>
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


        <!--Footer start-->
        <?php include "layout/footer.html"?>
        <!--Footer end-->        