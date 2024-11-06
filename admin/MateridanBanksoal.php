<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Sabi - Materi dan Bank Soal </title>
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
        <!--Nav header end-->

        <!--Header start-->
        <?php include "layout/header.html"?>
        <!--Header end-->

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
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Manajemen Konten</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Materi Bank dan Soal</a></li>
                        </ol>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-block">
                            <h4 class="card-title">Materi dan Bank Soal</h4>
                            <p class="m-0 subtitle">Pilih mata pelajaran untuk melihat Pelajaran</p>
                
                            <!-- Button Tambah Mata Pelajaran -->
                            <button class="btn btn-success float-right" data-toggle="modal" data-target="#modalTambahPelajaran">
                                <i class="fas fa-plus"></i> Tambah Mata Pelajaran
                            </button>
                        </div>
                
                        <div class="card-body">
                            <div id="accordion-materi" class="accordion accordion-with-icon">
                                <!-- (Your dynamically generated accordion goes here) -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Modal Tambah Mata Pelajaran -->
                <div class="modal fade" id="modalTambahPelajaran" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Tambah Mata Pelajaran</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="formTambahPelajaran">
                                    <div class="form-group">
                                        <label for="namaPelajaran">Nama Mata Pelajaran</label>
                                        <input type="text" class="form-control" id="namaPelajaran" placeholder="Masukkan Nama Mata Pelajaran" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlahBab">Jumlah Bab</label>
                                        <input type="number" class="form-control" id="jumlahBab" placeholder="Masukkan Jumlah Bab" required>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-primary" onclick="tambahPelajaran()">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Modal Edit Bab -->
                <div class="modal fade" id="modalEditBab" tabindex="-1" role="dialog" aria-labelledby="editBabLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editBabLabel">Edit Bab</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="formEditBab">
                                    <div class="form-group">
                                        <label for="editBabTitle">Judul Bab</label>
                                        <input type="text" class="form-control" id="editBabTitle" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="editBabFile">Ganti File</label>
                                        <input type="file" class="form-control-file" id="editBabFile">
                                    </div>
                                    <div id="editFilePreview" class="mt-2"></div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-primary" onclick="saveBabEdit()">Simpan Perubahan</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- JavaScript -->
                <script>
                let selectedBabElement = null;
                
                function tambahPelajaran() {
                    const namaPelajaran = document.getElementById('namaPelajaran').value;
                    const jumlahBab = document.getElementById('jumlahBab').value;
                
                    if (namaPelajaran && jumlahBab) {
                        const accordion = document.getElementById('accordion-materi');
                        const newItem = document.createElement('div');
                        newItem.className = 'accordion__item';
                
                        let content = `
                            <div class="accordion__header collapsed" data-toggle="collapse" data-target="#collapse${namaPelajaran.replace(/\s/g, '')}">
                                <span class="accordion__header--icon"><i class="bi bi-book"></i></span>
                                <span class="accordion__header--text">${namaPelajaran}</span>
                                <span class="accordion__header--indicator indicator_bordered"></span>
                            </div>
                            <div id="collapse${namaPelajaran.replace(/\s/g, '')}" class="collapse accordion__body" data-parent="#accordion-materi">
                                <div class="accordion__body--text">
                                    <ul class="list-group">`;
                
                        for (let i = 1; i <= jumlahBab; i++) {
                            content += `
                                <li class="list-group-item" id="bab${i}">
                                    <span class="bab-title">Bab ${i}: Judul Bab ${i}</span>
                                    <button class="btn btn-warning btn-sm float-right ml-2" onclick="editBab(this)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form class="mt-2">
                                        <div class="form-group">
                                            <label for="uploadBab${i}">Upload File:</label>
                                            <input type="file" class="form-control-file" id="uploadBab${i}" onchange="previewFile(event, 'filePreviewBab${i}')">
                                        </div>
                                    </form>
                                    <div id="filePreviewBab${i}" class="mt-2"></div>
                                </li>`;
                        }
                
                        content += `
                                    </ul>
                                </div>
                            </div>`;
                
                        newItem.innerHTML = content;
                        accordion.appendChild(newItem);
                
                        $('#modalTambahPelajaran').modal('hide');
                        document.getElementById('formTambahPelajaran').reset();
                    } else {
                        alert('Mohon isi semua kolom!');
                    }
                }
                
                function editBab(button) {
                    selectedBabElement = button.closest('li');
                    const babTitle = selectedBabElement.querySelector('.bab-title').textContent;
                    document.getElementById('editBabTitle').value = babTitle;
                
                    const filePreview = selectedBabElement.querySelector('div[id^="filePreviewBab"]').innerHTML;
                    document.getElementById('editFilePreview').innerHTML = filePreview;
                
                    $('#modalEditBab').modal('show');
                }
                
                function saveBabEdit() {
                    const newBabTitle = document.getElementById('editBabTitle').value;
                    if (newBabTitle) {
                        selectedBabElement.querySelector('.bab-title').textContent = newBabTitle;
                        const newFileInput = document.getElementById('editBabFile');
                
                        if (newFileInput.files.length > 0) {
                            const filePreviewId = selectedBabElement.querySelector('div[id^="filePreviewBab"]').id;
                            previewFile({ target: newFileInput }, filePreviewId);
                        }
                
                        $('#modalEditBab').modal('hide');
                    } else {
                        alert('Nama Bab tidak boleh kosong!');
                    }
                }
                
                function previewFile(event, previewId) {
                    const file = event.target.files[0];
                    const previewDiv = document.getElementById(previewId);
                
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            previewDiv.innerHTML = `
                                <a href="${e.target.result}" target="_blank"><i class="fas fa-eye"></i> Lihat</a>
                                <a href="${e.target.result}" download="${file.name}" class="btn btn-primary btn-sm ml-2">
                                    <i class="fas fa-download"></i>
                                </a>
                                <button class="btn btn-danger btn-sm ml-2" onclick="deleteFile('${previewId}')">
                                    <i class="fas fa-trash"></i>
                                </button>`;
                        };
                        reader.readAsDataURL(file);
                    }
                }
                
                function deleteFile(previewId) {
                    document.getElementById(previewId).innerHTML = '';
                }
                </script>
                <!-- Font Awesome CDN -->
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

    <!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>
    



</body>

</html>