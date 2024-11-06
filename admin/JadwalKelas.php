<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>SABI - Sahabat Bimbel </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="./css/style.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="./images/logo4.png" alt="">
                <img class="logo-compact" src="./images/logo-text.png" alt="">
                <img class="brand-title" src="./images/logo text3.png" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--Header start-->
        <?php include "layout/header.html"?>
        <!-- Header end-->

        <!--Sidebar start-->
        <?php include "layout/sidebar.html"?>
        <!--Sidebar end-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, Syaiful!</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Manajemen Konten</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Jadwal</a></li>
                        </ol>
                    </div>
                </div>

                                               <!-- Include DataTables CSS & JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<div class="container">

    <!-- Table Jadwal -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Jadwal Mengajar</h4>
                </div>

    <!-- Button tambah jadwal -->
    <div class="row mb-3">
        <div class="col-lg-8 col-12" style="margin-top: -30px; margin-left: 170px;">
            <button class="btn btn-success" data-toggle="modal" data-target="#addJadwalMengajar">
                <i class="fa fa-plus"></i> Tambah Jadwal
            </button>
        </div>
    </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="jadwalTable" class="display" style="width: 100%;">
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
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Senin</td>
                                    <td>11 MIPA</td>
                                    <td>Fisika</td>
                                    <td>14.00-15.00</td>
                                    <td>Syaiful Amin</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary editJadwalBtn">
                                            <i class="fa fa-edit"></i> 
                                        </button>
                                        <button class="btn btn-sm btn-danger deleteJadwalBtn">
                                            <i class="fa fa-trash"></i> 
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Selasa</td>
                                    <td>10 IPS</td>
                                    <td>Matematika</td>
                                    <td>08.00-09.00</td>
                                    <td>Ali Muhammad</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary editJadwalBtn">
                                            <i class="fa fa-edit"></i> 
                                        </button>
                                        <button class="btn btn-sm btn-danger deleteJadwalBtn">
                                            <i class="fa fa-trash"></i> 
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Tambah Jadwal -->
<div class="modal fade" id="addJadwalMengajar" tabindex="-1" role="dialog" aria-labelledby="addJadwalMengajarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addJadwalMengajarLabel">Tambah Jadwal Mengajar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Jadwal -->
                <form id="formAddJadwal">
                    <div class="form-group">
                        <label for="hari">Hari</label>
                        <input type="text" class="form-control" id="hari" required>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Nama Kelas</label>
                        <input type="text" class="form-control" id="kelas" required>
                    </div>
                    <div class="form-group">
                        <label for="mataPelajaran">Mata Pelajaran</label>
                        <input type="text" class="form-control" id="mataPelajaran" required>
                    </div>
                    <div class="form-group">
                        <label for="rentangWaktu">Rentang Waktu</label>
                        <input type="text" class="form-control" id="rentangWaktu" required>
                    </div>
                    <div class="form-group">
                        <label for="guru">Nama Guru</label>
                        <input type="text" class="form-control" id="guru" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Edit Jadwal -->
<div class="modal fade" id="editJadwalMengajar" tabindex="-1" role="dialog" aria-labelledby="editJadwalMengajarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editJadwalMengajarLabel">Edit Jadwal Mengajar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Edit Jadwal -->
                <form id="formEditJadwal">
                    <div class="form-group">
                        <label for="editHari">Hari</label>
                        <input type="text" class="form-control" id="editHari" required>
                    </div>
                    <div class="form-group">
                        <label for="editKelas">Nama Kelas</label>
                        <input type="text" class="form-control" id="editKelas" required>
                    </div>
                    <div class="form-group">
                        <label for="editMataPelajaran">Mata Pelajaran</label>
                        <input type="text" class="form-control" id="editMataPelajaran" required>
                    </div>
                    <div class="form-group">
                        <label for="editRentangWaktu">Rentang Waktu</label>
                        <input type="text" class="form-control" id="editRentangWaktu" required>
                    </div>
                    <div class="form-group">
                        <label for="editGuru">Nama Guru</label>
                        <input type="text" class="form-control" id="editGuru" required>
                    </div>
                    <input type="hidden" id="editRowIndex">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<!-- JavaScript untuk SweetAlert2 dan Fungsi Form -->
<script>
// Fungsi Tambah/Edit Data
$(document).ready(function () {
    var table = $('#jadwalTable').DataTable();

    // Tambah Jadwal
    $('#formAddJadwal').on('submit', function (e) {
        e.preventDefault();

        var hari = $('#hari').val();
        var kelas = $('#kelas').val();
        var mataPelajaran = $('#mataPelajaran').val();
        var rentangWaktu = $('#rentangWaktu').val();
        var guru = $('#guru').val();

        table.row.add([
            table.rows().count() + 1,
            hari,
            kelas,
            mataPelajaran,
            rentangWaktu,
            guru,
            `<button class="btn btn-sm btn-primary editJadwalBtn"><i class="fa fa-edit"></i> Edit</button>
             <button class="btn btn-sm btn-danger deleteJadwalBtn"><i class="fa fa-trash"></i> Hapus</button>`
        ]).draw(false);

        $('#addJadwalMengajar').modal('hide');
        $('#formAddJadwal')[0].reset();
    });

    // Edit Jadwal
    $('#jadwalTable tbody').on('click', '.editJadwalBtn', function () {
        var data = table.row($(this).parents('tr')).data();

        $('#editHari').val(data[1]);
        $('#editKelas').val(data[2]);
        $('#editMataPelajaran').val(data[3]);
        $('#editRentangWaktu').val(data[4]);
        $('#editGuru').val(data[5]);
        $('#editRowIndex').val(table.row($(this).parents('tr')).index());

        $('#editJadwalMengajar').modal('show');
    });

    // Update Jadwal
    $('#formEditJadwal').on('submit', function (e) {
        e.preventDefault();

        var rowIndex = $('#editRowIndex').val();
        table.row(rowIndex).data([
            rowIndex + 1,
            $('#editHari').val(),
            $('#editKelas').val(),
            $('#editMataPelajaran').val(),
            $('#editRentangWaktu').val(),
            $('#editGuru').val(),
            `<button class="btn btn-sm btn-primary editJadwalBtn"><i class="fa fa-edit"></i> Edit</button>
             <button class="btn btn-sm btn-danger deleteJadwalBtn"><i class="fa fa-trash"></i> Hapus</button>`
        ]).draw();

        $('#editJadwalMengajar').modal('hide');
        $('#formEditJadwal')[0].reset();
    });

    // Hapus Jadwal
    $('#jadwalTable tbody').on('click', '.deleteJadwalBtn', function () {
        table.row($(this).parents('tr')).remove().draw();
    });
});

</script>






            </div>
        </div>
        <!--**********************************
                Content body end
            ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Quixkit</a> 2019</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->

        
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
    
    <!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>



</body>

</html>