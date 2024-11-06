<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>SABI - Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/logosabi.png">
    <link href="./vendor/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <link href="./vendor/chartist/css/chartist.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
</head>

<body>

    <!--Preloader start-->
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
                            <h4>Hi, Syaiful!</h4>
                            <p class="mb-0">Admin</p>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        </ol>
                    </div>
                </div>

        <!-- Include DataTables CSS & JS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

        <div class="container">
            <!-- Jumlah Guru, Siswa, Kelas -->
            <div class="row mb-3">
                <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon d-inline-block">
                                <i class="ti-user text-success border-success"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Guru</div>
                                <div class="stat-digit">15</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon d-inline-block">
                                <i class="ti-book text-primary border-primary"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Siswa</div>
                                <div class="stat-digit">19</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon d-inline-block">
                                <i class="ti-clipboard text-pink border-pink"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Kelas</div>
                                <div class="stat-digit">3</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Jadwal Mengajar and Siswa Ter-Ambis -->
            <div class="row">
                <!-- Table Jadwal Mengajar -->
                <div class="col-lg-8 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Status User</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Hari</th>
                                            <th>Nama Kelas</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Rentang Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Senin</td>
                                            <td>11 MIPA</td>
                                            <td>Fisika</td>
                                            <td>14.00-15.00</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Senin</td>
                                            <td>11 MIPA</td>
                                            <td>Fisika</td>
                                            <td>14.00-15.00</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Senin</td>
                                            <td>11 MIPA</td>
                                            <td>Fisika</td>
                                            <td>14.00-15.00</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Hari</th>
                                            <th>Nama Kelas</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Rentang Waktu</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Siswa Ter-Ambis Card -->
                <div class="col-lg-4 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Riwayat Login</h4>
                        </div>
                        <div class="card-body">
                            <div class="recent-comment m-t-15">
                                <div class="media mb-3">
                                    <div class="media-left">
                                        <a href="#"><img class="media-object mr-3" src="./images/avatar/4.png" alt="..." style="width: 40px; height: 40px;"></a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading text-primary">John Doe</h4>
                                        <p>Cras sit amet nibh libero, in gravida nulla.</p>
                                        <p class="comment-date">10 min ago</p>
                                    </div>
                                </div>
                                <div class="media mb-3">
                                    <div class="media-left">
                                        <a href="#"><img class="media-object mr-3" src="./images/avatar/2.png" alt="..." style="width: 40px; height: 40px;"></a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading text-success">Mr. John</h4>
                                        <p>Cras sit amet nibh libero, in gravida nulla.</p>
                                        <p class="comment-date">1 hour ago</p>
                                    </div>
                                </div>
                                <div class="media mb-3">
                                    <div class="media-left">
                                        <a href="#"><img class="media-object mr-3" src="./images/avatar/3.png" alt="..." style="width: 40px; height: 40px;"></a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading text-danger">Mr. John</h4>
                                        <p>Cras sit amet nibh libero, in gravida nulla.</p>
                                        <p class="comment-date">Yesterday</p>
                                    </div>
                                </div>
                                <div class="media mb-3">
                                    <div class="media-left">
                                        <a href="#"><img class="media-object mr-3" src="./images/avatar/4.png" alt="..." style="width: 40px; height: 40px;"></a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading text-primary">John Doe</h4>
                                        <p>Cras sit amet nibh libero, in gravida nulla.</p>
                                        <p class="comment-date">10 min ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
        <!--Content body end-->

        <!--Footer start-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Team Sabi</a> 2019</p>
                <p>Distributed by <a href="https://themewagon.com/" target="_blank">Themewagon</a></p>
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

    <script src="./vendor/chartist/js/chartist.min.js"></script>

    <script src="./vendor/moment/moment.min.js"></script>
    <script src="./vendor/pg-calendar/js/pignose.calendar.min.js"></script>


    <script src="./js/dashboard/dashboard-2.js"></script>

    <!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>

    <!-- Circle progress -->

</body>

</html>