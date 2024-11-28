<?php
require_once '../../layout/top.php';
require_once '../../helper/conek.php';
?>

<!-- Content Body Start -->
<div class="content-body">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Raport Siswa</h4>
                    </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="display" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Matematika</th>
                            <th>Fisika</th>
                            <th>Kimia</th>
                            <th>Nilai Rata-Rata</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Matematika</th>
                            <th>Fisika</th>
                            <th>Kimia</th>
                            <th>Nilai Rata-Rata</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!--Content body end-->

<?php
require_once '../../layout/footer.php';
?>
