<?php
require_once '../../layout/top.php';
 ?>

    <!--Content body start-->
    <div class="content-body">
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
                                <button class="btn" style="background-color: #146E70; color: white;" data-toggle="modal" data-target="#addDataKelas">
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
                                <button type="submit" class="btn" style="background-color: #146E70; color: white;">Tambah</button>
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
                            `<button class="btn btn-sm btn-primary editKelasBtn"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger deleteKelasBtn"><i class="fa fa-trash"></i></button>
                            <button class="btn btn-sm btn-warning viewKelasBtn" data-kelas="${kelasNama}"><i class="fa fa-eye"></i></button>`
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
        </div>
    </div>
        
        <!--Content body end-->

<?php
require_once '../../layout/footer.php';
?>
