<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Focus - Bootstrap Admin Dashboard </title>
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
        <!--Header end-->

        <!--Sidebar start-->
        <?php include "layout/sidebar.html"?>
        <!--Sidebar end-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body badge-demo">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, Syaiful!</h4>
                            <span class="ml-1">Kelas</span>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Manajemen Konten</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Kelas</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                                    <!-- Include DataTables CSS & JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="container">
    <!-- Table Kelas -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Kelas</h4>
                </div>

                <!-- Button tambah kelas -->
                <div class="row mb-3">
                    <div class="col-lg-8 col-12" style="margin-top: -30px; margin-left: 120px;">
                        <button class="btn btn-success" data-toggle="modal" data-target="#addDataKelas">
                            <i class="fa fa-plus"></i> Tambah Kelas
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="kelasTable" class="display" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kelas</th>
                                    <th>Jumlah Siswa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data kelas akan dimuat di sini secara dinamis -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Modal untuk Tambah Kelas -->
<div class="modal fade" id="addDataKelas" tabindex="-1" role="dialog" aria-labelledby="addDataKelasLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDataKelasLabel">Tambah Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAddKelas">
                    <div class="form-group">
                        <label for="kelasNama">Nama Kelas</label>
                        <input type="text" class="form-control" id="kelasNama" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlahSiswa">Jumlah Siswa</label>
                        <input type="number" class="form-control" id="jumlahSiswa" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Data Siswa di Kelas -->
<div class="modal fade" id="viewKelasModal" tabindex="-1" aria-labelledby="viewKelasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewKelasModalLabel">Data Siswa Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="siswaTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Siswa</th>
                            <th>Umur</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data siswa akan dimuat di sini secara dinamis -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

 <!-- JavaScript untuk Fungsi Pencarian, Tambah/Edit, Hapus, dan Lihat Kelas -->
 <script>
    $(document).ready(function () {
        // Inisialisasi DataTable
        const table = $('#kelasTable').DataTable();

        // Fungsi Tambah Kelas
        $('#formAddKelas').on('submit', function (event) {
            event.preventDefault();
            const kelasNama = $('#kelasNama').val();
            const jumlahSiswa = $('#jumlahSiswa').val();

            table.row.add([
                table.rows().count() + 1,
                kelasNama,
                jumlahSiswa,
                `<button class="btn btn-sm btn-primary editKelasBtn"><i class="fa fa-edit"></i> Edit</button>
                 <button class="btn btn-sm btn-danger deleteKelasBtn"><i class="fa fa-trash"></i> Hapus</button>
                 <button class="btn btn-sm btn-info viewKelasBtn" data-kelas="${kelasNama}"><i class="fa fa-eye"></i> Lihat Kelas</button>`
            ]).draw();

            $('#addDataKelas').modal('hide');
            this.reset();
        });

        // Fungsi Edit Data Kelas
        $('#kelasTable tbody').on('click', '.editKelasBtn', function () {
            const row = table.row($(this).parents('tr')).data();
            $('#kelasNama').val(row[1]);
            $('#jumlahSiswa').val(row[2]);
            $('#addDataKelas').modal('show');

            // Hapus baris sebelum menambahkan kembali
            $('#formAddKelas').off('submit').on('submit', function (event) {
                event.preventDefault();
                row[1] = $('#kelasNama').val();
                row[2] = $('#jumlahSiswa').val();
                table.row($(this).parents('tr')).data(row).draw();
                $('#addDataKelas').modal('hide');
            });
        });

        // Fungsi Hapus Data
        $('#kelasTable tbody').on('click', '.deleteKelasBtn', function () {
            const row = table.row($(this).parents('tr'));
            row.remove().draw();
        });

        // Fungsi Lihat Data Siswa di Kelas
        $('#kelasTable tbody').on('click', '.viewKelasBtn', function () {
            const kelas = $(this).data('kelas');
            $('#viewKelasModalLabel').text(`Data Siswa Kelas ${kelas}`);

            // Contoh data siswa berdasarkan kelas
            const siswaData = {
                '11 MIPA': [
                    { id: 1, nama: 'Ahmad', umur: 17, alamat: 'Jl. Merdeka' },
                    { id: 2, nama: 'Budi', umur: 16, alamat: 'Jl. Karya' }
                ],
                '12 MIPA': [
                    { id: 1, nama: 'Siti', umur: 18, alamat: 'Jl. Lestari' }
                ]
            };

            const siswaTableBody = $('#siswaTable tbody');
            siswaTableBody.empty(); // Kosongkan tabel sebelum memuat data baru

            if (siswaData[kelas]) {
                siswaData[kelas].forEach(siswa => {
                    siswaTableBody.append(`
                        <tr>
                            <td>${siswa.id}</td>
                            <td>${siswa.nama}</td>
                            <td>${siswa.umur}</td>
                            <td>${siswa.alamat}</td>
                        </tr>
                    `);
                });
            } else {
                siswaTableBody.append(`<tr><td colspan="4" class="text-center">Tidak ada data siswa</td></tr>`);
            }

            $('#viewKelasModal').modal('show');
        });
    });
    </script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>

</body>

</html>