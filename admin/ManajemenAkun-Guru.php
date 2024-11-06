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

        <!--**********************************
            Header start
        ***********************************-->
        <?php include "layout/header.html"?>
        <!--Header end ti-comment-alt-->

        <!--Sidebar start-->
        <?php include "layout/sidebar.html"?>
        <!--Sidebar end-->

        <!--Content body start-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            Manajemen Akun Guru
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Manajemen Akun</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Guru</a></li>
                        </ol>
                    </div>
                </div>
        
                <!-- Include DataTables CSS & JS -->
                <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
                
                <!-- SweetAlert2 -->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <div class="container">
                    <!-- Table Data Guru -->
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
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <!-- Modal untuk Tambah Akun Guru -->
                        <div class="modal fade" id="addAkunGuru" tabindex="-1" role="dialog" aria-labelledby="addAkunGuruLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addAkunGuruLabel">Tambah Data Guru</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form Tambah Akun Guru -->
                                        <form id="formAddGuru">
                                            <div class="form-group">
                                                <label for="namaGuru">Nama Guru</label>
                                                <input type="text" class="form-control" id="namaGuru" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <input type="text" class="form-control" id="alamat" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="telepon">Telepon</label>
                                                <input type="text" class="form-control" id="telepon" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="kategori">Kategori</label>
                                                <input type="text" class="form-control" id="kategori" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <!-- Modal untuk Edit Akun Guru -->
                        <div class="modal fade" id="editAkunGuru" tabindex="-1" role="dialog" aria-labelledby="editAkunGuruLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editAkunGuruLabel">Edit Data Guru</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form Edit Akun Guru -->
                                        <form id="formEditGuru">
                                            <div class="form-group">
                                                <label for="editNamaGuru">Nama Guru</label>
                                                <input type="text" class="form-control" id="editNamaGuru" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="editEmail">Email</label>
                                                <input type="email" class="form-control" id="editEmail" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="editPassword">Password</label>
                                                <input type="password" class="form-control" id="editPassword" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="editAlamat">Alamat</label>
                                                <input type="text" class="form-control" id="editAlamat" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="editTelepon">Telepon</label>
                                                <input type="text" class="form-control" id="editTelepon" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="editKategori">Kategori</label>
                                                <input type="text" class="form-control" id="editKategori" required>
                                            </div>
                                            <input type="hidden" id="editRowIndex">
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
        
            <!-- JavaScript untuk SweetAlert2 dan Fungsi Form -->
            <script>
                $(document).ready(function () {
                    var table = $('#guruTable').DataTable();
            
                    // Tambah Guru
                    $('#formAddGuru').on('submit', function (e) {
                        e.preventDefault();
            
                        var namaGuru = $('#namaGuru').val();
                        var email = $('#email').val();
                        var password = $('#password').val();
                        var alamat = $('#alamat').val();
                        var telepon = $('#telepon').val();
                        var kategori = $('#kategori').val();
            
                        table.row.add([
                            table.rows().count() + 1, // ID otomatis
                            namaGuru,
                            email,
                            password,
                            alamat,
                            telepon,
                            kategori,
                            `<button class="btn btn-sm btn-primary editGuruBtn"><i class="fa fa-edit"></i></button>
                             <button class="btn btn-sm btn-danger deleteGuruBtn"><i class="fa fa-trash"></i></button>`
                        ]).draw(false);
            
                        $('#addAkunGuru').modal('hide');
                        $('#formAddGuru')[0].reset();
                    });
            
                    // Event Listener untuk Tombol Edit Guru
                    $('#guruTable tbody').on('click', '.editGuruBtn', function () {
                        var data = table.row($(this).parents('tr')).data();
                        
                        // Menyimpan data di modal edit
                        $('#editNamaGuru').val(data[1]);
                        $('#editEmail').val(data[2]);
                        $('#editPassword').val(data[3]);
                        $('#editAlamat').val(data[4]);
                        $('#editTelepon').val(data[5]);
                        $('#editKategori').val(data[6]);
                        $('#editRowIndex').val(table.row($(this).parents('tr')).index());
            
                        $('#editAkunGuru').modal('show');
                    });
            
                    // Update Data Guru Setelah Pengeditan
                    $('#formEditGuru').on('submit', function (e) {
                        e.preventDefault();
            
                        var rowIndex = $('#editRowIndex').val();
                        table.row(rowIndex).data([
                            rowIndex + 1, // ID tetap sama
                            $('#editNamaGuru').val(),
                            $('#editEmail').val(),
                            $('#editPassword').val(),
                            $('#editAlamat').val(),
                            $('#editTelepon').val(),
                            $('#editKategori').val(),
                            `<button class="btn btn-sm btn-primary editGuruBtn"><i class="fa fa-edit"></i></button>
                             <button class="btn btn-sm btn-danger deleteGuruBtn"><i class="fa fa-trash"></i></button>`
                        ]).draw();
            
                        $('#editAkunGuru').modal('hide');
                        $('#formEditGuru')[0].reset();
                    });
            
                    // Hapus Guru dengan SweetAlert2
                    $('#guruTable tbody').on('click', '.deleteGuruBtn', function () {
                        const row = table.row($(this).closest('tr'));
                        Swal.fire({
                            title: 'Apakah Anda yakin ingin menghapus data ini?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                table.row(row).remove().draw();
                                Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success');
                            }
                        });
                    });
                });
            </script>
            
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
                    </div>
                </div>
            </div>
        </div>
        <!--Content body end-->


        <!--Footer start-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Quixkit</a> 2019</p>
            </div>
        </div>
        <!--Footer end-->        
    </div>

    <!--Main wrapper end-->

    <!--Scripts-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
    
    <!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>
</body>

</html>