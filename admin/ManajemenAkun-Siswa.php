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
        <!--Header end ti-comment-alt-->

        <!--Sidebar start*-->
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
                            Manajemen Akun Siswa
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Manajemen Akun</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Siswa</a></li>
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
                    <!-- Table Data Siswa -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Data Siswa</h4>
                                </div>
        
                                <!-- Button Tambah Akun -->
                                <div class="row mb-3">
                                    <div class="col-lg-8 col-12" style="margin-top: -30px; margin-left: 120px;">
                                        <button class="btn btn-success" data-toggle="modal" data-target="#addAkunSiswa">
                                            <i class="fa fa-plus"></i> Tambah Akun Siswa
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="siswaTable" class="display" style="width: 100%;">
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
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <!-- Modal untuk Tambah Akun Siswa -->
                        <div class="modal fade" id="addAkunSiswa" tabindex="-1" role="dialog" aria-labelledby="addAkunSiswaLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addAkunSiswaLabel">Tambah Data Siswa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form Tambah Akun Siswa -->
                                        <form id="formAddSiswa">
                                            <div class="form-group">
                                                <label for="namaSiswa">Nama Siswa</label>
                                                <input type="text" class="form-control" id="namaSiswa" required>
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
                                                <label for="kelamin">Kelas</label>
                                                <select class="form-control" id="kelamin">
                                                    <option selected="">Pilih Jenis Kelamin...</option>
                                                    <option>Laki-Laki</option>
                                                    <option>Perempuan</option>
                                                </select>
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
                                                <label for="tanggalLahir">Tanggal Lahir</label>
                                                <input type="date" class="form-control" id="tanggalLahir" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="kelas">Kelas</label>
                                                <select class="form-control" id="kelas">
                                                    <option selected="">Pilih Kelas...</option>
                                                    <option>X MIPA 1</option>
                                                    <option>X MIPA 2</option>
                                                    <option>X MIPA 3</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="ortu">Orang Tua/Wali</label>
                                                <input type="text" class="form-control" id="ortu" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <script>
                            $(document).ready(function () {
                                var table = $('#siswaTable').DataTable();
                        
                                // Tambah Siswa
                                $('#formAddSiswa').on('submit', function (e) {
                                    e.preventDefault();
                        
                                    var namaSiswa = $('#namaSiswa').val();
                                    var email = $('#email').val();
                                    var password = $('#password').val();
                                    var kelamin = $('#kelamin').val();
                                    var alamat = $('#alamat').val();
                                    var telepon = $('#telepon').val();
                                    var tanggalLahir = $('#tanggalLahir').val();
                                    var kelas = $('#kelas').val();
                                    var ortu = $('#ortu').val();
                        
                                    table.row.add([
                                        table.rows().count() + 1, // ID otomatis
                                        namaSiswa,
                                        email,
                                        password,
                                        kelamin,
                                        alamat,
                                        telepon,
                                        tanggalLahir,
                                        kelas,
                                        ortu,
                                        `<button class="btn btn-sm btn-primary editSiswaBtn"><i class="fa fa-edit"></i></button>
                                         <button class="btn btn-sm btn-danger deleteSiswaBtn"><i class="fa fa-trash"></i></button>`
                                    ]).draw(false);
                        
                                    $('#addAkunSiswa').modal('hide');
                                    $('#formAddSiswa')[0].reset();
                                });
                        
                                // Event Delegation untuk Edit Siswa
                                $('#siswaTable tbody').on('click', '.editSiswaBtn', function () {
                                    var data = table.row($(this).parents('tr')).data();
                        
                                    $('#editNamaSiswa').val(data[1]);
                                    $('#editEmail').val(data[2]);
                                    $('#editPassword').val(data[3]);
                                    $('#editKelamin').val(data[4]);
                                    $('#editAlamat').val(data[5]);
                                    $('#editTelepon').val(data[6]);
                                    $('#editTanggalLahir').val(data[7]);
                                    $('#editKelas').val(data[8]);
                                    $('#editOrtu').val(data[9]);
                                    $('#editRowIndex').val(table.row($(this).parents('tr')).index());
                        
                                    $('#editAkunSiswa').modal('show');
                                });
                        
                                // Update Siswa Setelah Pengeditan
                                $('#formEditSiswa').on('submit', function (e) {
                                    e.preventDefault();
                        
                                    var rowIndex = $('#editRowIndex').val();
                                    table.row(rowIndex).data([
                                        rowIndex + 1, // ID tetap sama
                                        $('#editNamaSiswa').val(),
                                        $('#editEmail').val(),
                                        $('#editPassword').val(),
                                        $('#editKelamin').val(),
                                        $('#editAlamat').val(),
                                        $('#editTelepon').val(),
                                        $('#editTanggalLahir').val(),
                                        $('#editKelas').val(),
                                        $('#editOrtu').val(),
                                        `<button class="btn btn-sm btn-primary editSiswaBtn"><i class="fa fa-edit"></i></button>
                                         <button class="btn btn-sm btn-danger deleteSiswaBtn"><i class="fa fa-trash"></i></button>`
                                    ]).draw();
                        
                                    $('#editAkunSiswa').modal('hide');
                                    $('#formEditSiswa')[0].reset();
                                });
                        
                                // Hapus Siswa
                                $('#siswaTable tbody').on('click', '.deleteSiswaBtn', function () {
                                    const row = $(this).closest('tr');
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