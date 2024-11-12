<?php
require_once '../../layout/top.php';
 ?>

        <!--Content body start-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi,!</h4>
                            <p class="mb-0">Guru</p>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        </ol>
                    </div>
                </div>
            
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
                                    <h4 class="card-title">Starus User</h4>
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
            </div>
        </div>
        
        <!--Content body end-->

<?php
require_once '../../layout/footer.php';
?>
