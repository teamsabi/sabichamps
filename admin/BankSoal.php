<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Sabi - Bank Soal </title>
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
    <!--Preloader end-->


    <!--Main wrapper start-->
    <div id="main-wrapper">

        <!--Nav header start-->
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
        <!--Header end -->

        <!--Sidebar start-->
        <?php include "layout/sidebar.html"?>
        <!--Sidebar end-->

        <!--Content body start-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, Syaiful!</h4>
                            <p class="mb-0">Admin</p>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Manajemen Konten</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Pembelajaran</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Bank Soal</a></li>
                        </ol>
                    </div>
                </div>
        
                            <!-- Include DataTables CSS & JS -->
                            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
                            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                            <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        
                            <div class="container">
                                <!-- Table Soal/Ujian -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Bank Soal</h4>
                                            </div>
        
                                            <!-- Button tambah jadwal -->
                                            <div class="row mb-3">
                                                <div class="col-lg-8 col-12" style="margin-top: -30px; margin-left: 110px;">
                                                    <button class="btn btn-success" data-toggle="modal" data-target="#addSoal">
                                                        <i class="fa fa-plus"></i> Tambah Soal/Ujian
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="SoalTable" class="display" style="width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama Soal Ujian</th>
                                                                <th>Keterangan</th>
                                                                <th>Buat Soal</th>
                                                                <th>Telah Mengerjakan</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <!-- Data Dummy -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <!-- Modal Tambah Soal/Ujian -->
                            <div class="modal fade" id="addSoal" tabindex="-1" role="dialog" aria-labelledby="modalSoalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel">Tambah Soal/Ujian</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="formTambahSoal">
                                                <div class="form-group">
                                                    <label for="namaUjian">Nama Soal Ujian</label>
                                                    <input type="text" class="form-control" id="namaUjian" placeholder="Masukkan Judul/Nama Ujian" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="mataPelajaran">Mata Pelajaran</label>
                                                    <input type="text" class="form-control" id="mataPelajaran" placeholder="Masukkan Nama Mata Pelajaran" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kelas">Kelas</label>
                                                    <input type="text" class="form-control" id="kelas" placeholder="Masukkan Kelas" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="waktuPengerjaan">Waktu Pengerjaan</label>
                                                    <input type="text" class="form-control" id="waktuPengerjaan" placeholder="Masukkan Waktu Pengerjaan" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="infoUjian">Info Soal Ujian</label>
                                                    <input type="text" class="form-control" id="infoUjian" placeholder="Masukkan Info Ujian" required>
                                                </div>
        
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <!-- Modal Edit Soal/Ujian -->
                            <div class="modal fade" id="editSoal" tabindex="-1" role="dialog" aria-labelledby="editSoalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-white text-white">
                                            <h5 class="modal-title" id="editSoalLabel">Edit Soal/Ujian</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form Edit Soal/Ujian -->
                                            <form id="formEditSoal">
                                                <div class="form-group">
                                                    <label for="editNamaSoal">Nama Soal Ujian</label>
                                                    <input type="text" class="form-control" id="editNamaSoal" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editMapel">Mata Pelajaran</label>
                                                    <input type="text" class="form-control" id="editMapel" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editKelas">Kelas</label>
                                                    <input type="text" class="form-control" id="editKelas" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editWaktu">Waktu Pengerjaan</label>
                                                    <input type="text" class="form-control" id="editWaktu" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editInfo">Info Soal Ujian</label>
                                                    <input type="text" class="form-control" id="editInfo" required>
                                                </div>
                                                <input type="hidden" id="editRowIndex">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
        
                    <!-- Modal Buat Soal -->
                    <div class="modal fade" id="buatSoal" tabindex="-1" role="dialog" aria-labelledby="buatSoalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="buatSoalLabel">Buat Soal</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Keterangan soal akan ditampilkan di sini -->
                                    <div class="mb-3">
                                        <h6>Nama Soal Ujian:</h6>
                                        <div id="namaSoal"></div>
                                    </div>
                                    <div class="mb-3">
                                        <h6>Keterangan Soal:</h6>
                                        <div id="keteranganSoal"></div>
                                    </div>
                                    
                                    <p class="text-center">Pilih jenis soal yang ingin Anda buat:</p>
                                    <div class="text-center">
                                        <!-- Tombol untuk mengarahkan ke halaman pembuatan soal pilihan ganda -->
                                        <a href="soalpilgan.html" class="btn btn-primary">Soal Pilihan Ganda</a>
                                        <!-- Tombol untuk mengarahkan ke halaman pembuatan soal essay -->
                                        <a href="soalessay.html" class="btn btn-secondary">Soal Essay</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
        
                    <!-- JavaScript untuk SweetAlert2 dan Fungsi Form -->
                    <script>
                        $(document).ready(function () {
        
                            // Inisialisasi DataTable
                            var table = $('#SoalTable').DataTable();
        
                            // Tambah Soal
                            $('#formTambahSoal').on('submit', function (e) {
                                e.preventDefault();
        
                                var namaUjian = $('#namaUjian').val();
                                var mataPelajaran = $('#mataPelajaran').val();
                                var kelas = $('#kelas').val();
                                var waktuPengerjaan = $('#waktuPengerjaan').val();
                                var infoUjian = $('#infoUjian').val();
        
                                var keterangan = `<ol>
                                                    <li>Pelajaran: ${mataPelajaran}</li>
                                                    <li>Kelas: ${kelas}</li>
                                                    <li>Waktu Pengerjaan: ${waktuPengerjaan}</li>
                                                    <li>Info Soal Ujian: ${infoUjian}</li>
                                                </ol>`;
        
                                console.log("Data soal baru:", namaUjian, keterangan);
        
                                table.row.add([
                                    table.rows().count() + 1,
                                    namaUjian,
                                    keterangan,
                                    `<button class="btn btn-sm btn-warning buatSoalBtn"><i class="fa fa-file-text"></i></button>`,
                                    `<button class="btn btn-sm btn-info lihatTelahUjianBtn"><i class="fa fa-graduation-cap"></i></button>`,
                                    `<button class="btn btn-sm btn-primary editSoalBtn"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger deleteSoalBtn"><i class="fa fa-trash"></i></button>`
                                ]).draw();
        
                                $('#addSoal').modal('hide');
                                $('#formTambahSoal')[0].reset();
                            });
        
                            // Edit Soal
                    $('#SoalTable tbody').on('click', '.editSoalBtn', function () {
                        var data = table.row($(this).parents('tr')).data();
                        
                        // Extract plain text from the HTML content in 'data[2]'
                        var tempDiv = document.createElement("div");
                        tempDiv.innerHTML = data[2];
                        var listItems = tempDiv.querySelectorAll("li");
        
                        // Retrieve the text content of each list item and remove any labels like "Pelajaran: "
                        var mataPelajaran = listItems[0].textContent.split(": ")[1].trim();
                        var kelas = listItems[1].textContent.split(": ")[1].trim();
                        var waktuPengerjaan = listItems[2].textContent.split(": ")[1].trim();
                        var infoUjian = listItems[3].textContent.split(": ")[1].trim();
        
                        // Set the values in the edit form fields
                        $('#editNamaSoal').val(data[1]); // Nama Ujian
                        $('#editMapel').val(mataPelajaran); // Mata pelajaran
                        $('#editKelas').val(kelas); // Kelas
                        $('#editWaktu').val(waktuPengerjaan); // Waktu pengerjaan
                        $('#editInfo').val(infoUjian); // Info ujian
                        $('#editRowIndex').val(table.row($(this).parents('tr')).index());
        
                        $('#editSoal').modal('show');
                    });
        
                    // Handle the form submission to save changes
                    $('#formEditSoal').on('submit', function (e) {
                        e.preventDefault();
        
                        // Retrieve edited values from the form
                        var rowIndex = $('#editRowIndex').val();
                        var namaUjian = $('#editNamaSoal').val();
                        var mataPelajaran = $('#editMapel').val();
                        var kelas = $('#editKelas').val();
                        var waktuPengerjaan = $('#editWaktu').val();
                        var infoUjian = $('#editInfo').val();
        
                        // Format the data for the DataTable, especially the 'keterangan' field with updated values
                        var keterangan = `<ol>
                                            <li>Pelajaran: ${mataPelajaran}</li>
                                            <li>Kelas: ${kelas}</li>
                                            <li>Waktu Pengerjaan: ${waktuPengerjaan}</li>
                                            <li>Info Soal Ujian: ${infoUjian}</li>
                                        </ol>`;
        
                        // Update the DataTable row with the new data
                        table.row(rowIndex).data([
                            parseInt(rowIndex) + 1, // Row number
                            namaUjian, // Nama Ujian
                            keterangan, // Keterangan with updated values
                            `<button class="btn btn-sm btn-warning buatSoalBtn"><i class="fa fa-search"></i></button>`,
                            `<button class="btn btn-sm btn-info ihatTelahUjianBtn"><i class="fa fa-graduation-cap"></i></button>`,
                            `<button class="btn btn-sm btn-primary editSoalBtn"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger deleteSoalBtn"><i class="fa fa-trash"></i></button>`
                        ]).draw();
        
                        // Close the modal and reset the form
                        $('#editSoal').modal('hide');
                        $('#formEditSoal')[0].reset();
                    });
        
                        // Buat Soal Button in DataTable
                    $('#SoalTable tbody').on('click', '.buatSoalBtn', function () {
                        var data = table.row($(this).parents('tr')).data();
                        
                        // Ambil judul soal dari DataTable
                        var namaSoal = data[1]; // nama soal ada di kolom 2
        
                        // Ambil keterangan soal dari DataTable
                        var keteranganSoal = data[2]; // Keterangan soal ada di kolom 3 (index 2)
                        
                        // Masukkan nama dan keterangan soal ke dalam modal Buat Soal
                        $('#namaSoal').text(namaSoal); // Menampilkan nama soal
                        $('#keteranganSoal').html(keteranganSoal); // Menampilkan keterangan soal
        
                        // Tampilkan modal buat soal
                        $('#buatSoal').modal('show');
                    });
        
                            // Hapus Soal
                            $('#SoalTable tbody').on('click', '.deleteSoalBtn', function () {
                                table.row($(this).parents('tr')).remove().draw();
                            });
                        });
        
                        // Tambahkan fungsi untuk menangani klik pada tombol "Lihat Telah Ujian"
                        $('#SoalTable tbody').on('click', '.lihatTelahUjianBtn', function () {
                        // Mengarahkan ke halaman TelahMengerjakan.html
                        window.location.href = "TelahMengerjakan.html";
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

    <script src="./vendor/highlightjs/highlight.pack.min.js"></script>
    <!-- Circle progress -->

     <!-- Datatable -->
     <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
     <script src="./js/plugins-init/datatables.init.js"></script>

</body>

</html>