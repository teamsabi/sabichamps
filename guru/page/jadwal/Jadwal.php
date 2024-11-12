<?php
require_once '../../layout/top.php';
 ?>

        <!--Content body start-->
    <div class="content-body">
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
                                <button class="btn" style="background-color: #146E70; color: white;" data-toggle="modal" data-target="#addJadwalMengajar">
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
                                            <th>Waktu Mulai</th>
                                            <th>Waktu Selesai</th>
                                            <th>Nama Guru</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
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
                                    <label for="startTime">Waktu Mulai</label>
                                    <input type="time" id="startTime" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="endTime">Waktu Selesai</label>
                                    <input type="time" id="endTime" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="guru">Nama Guru</label>
                                    <input type="text" class="form-control" id="guru" required>
                                </div>
                                <button type="submit" class="btn" style="background-color: #146E70; color: white;">Tambah</button>
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
                                    <label for="editStartTime">Waktu Mulai</label>
                                    <input type="time" id="editStartTime" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="editEndTime">Waktu Selesai</label>
                                    <input type="time" id="editEndTime" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="editGuru">Nama Guru</label>
                                    <input type="text" class="form-control" id="editGuru" required>
                                </div>
                                <input type="hidden" id="editRowIndex">
                                <button type="submit" class="btn" style="background-color: #146E70; color: white;">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- JavaScript untuk SweetAlert2 dan Fungsi Form -->
            <script>
            $(document).ready(function () {
            var table = $('#jadwalTable').DataTable();

            // Tambah Jadwal - Notifikasi setelah tambah jadwal
            $('#formAddJadwal').on('submit', function (e) {
            e.preventDefault();

            var hari = $('#hari').val();
            var kelas = $('#kelas').val();
            var mataPelajaran = $('#mataPelajaran').val();
            var waktuMulai = $('#startTime').val();
            var waktuSelesai = $('#endTime').val();
            var guru = $('#guru').val();

            // Tambahkan data ke dalam tabel
            table.row.add([
                table.rows().count() + 1, 
                hari,
                kelas,
                mataPelajaran,
                waktuMulai,
                waktuSelesai,
                guru,
                `<button class="btn btn-sm btn-secondary editJadwalBtn"><i class="fa fa-edit"></i> </button>
                <button class="btn btn-sm btn-danger deleteJadwalBtn"><i class="fa fa-trash"></i> </button>`
            ]).draw(false);

            // Notifikasi sukses
            Swal.fire({
                icon: 'success',
                title: 'Jadwal berhasil ditambahkan',
                showConfirmButton: false,
                timer: 1500
            });

            $('#addJadwalMengajar').modal('hide');
            $('#formAddJadwal')[0].reset();
            });

            // Edit Jadwal
            $('#jadwalTable tbody').on('click', '.editJadwalBtn', function () {
            var data = table.row($(this).parents('tr')).data();

            $('#editHari').val(data[1]);
            $('#editKelas').val(data[2]);
            $('#editMataPelajaran').val(data[3]);
            $('#editStartTime').val(data[4]); // Waktu Mulai
            $('#editEndTime').val(data[5]); // Waktu Selesai
            $('#editGuru').val(data[6]);
            $('#editRowIndex').val(table.row($(this).parents('tr')).index());

            $('#editJadwalMengajar').modal('show');
            });

            // Update Jadwal - Notifikasi setelah simpan perubahan
            $('#formEditJadwal').on('submit', function (e) {
            e.preventDefault();

            var rowIndex = $('#editRowIndex').val();
            var waktuMulai = $('#editStartTime').val();
            var waktuSelesai = $('#editEndTime').val();

            // Update data pada tabel
            table.row(rowIndex).data([
                parseInt(rowIndex) + 1, // Nomor urut otomatis
                $('#editHari').val(),
                $('#editKelas').val(),
                $('#editMataPelajaran').val(),
                waktuMulai,
                waktuSelesai,
                $('#editGuru').val(),
                `<button class="btn btn-sm btn-secondary editJadwalBtn"><i class="fa fa-edit"></i> </button>
                <button class="btn btn-sm btn-danger deleteJadwalBtn"><i class="fa fa-trash"></i> </button>`
            ]).draw();

            // Menampilkan notifikasi setelah update
            Swal.fire({
                icon: 'success',
                title: 'Jadwal berhasil diperbarui',
                showConfirmButton: false,
                timer: 1500
            });

            $('#editJadwalMengajar').modal('hide');
            $('#formEditJadwal')[0].reset();
            });

            // Hapus Jadwal dengan Konfirmasi
            $('#jadwalTable tbody').on('click', '.deleteJadwalBtn', function () {
            var row = $(this).parents('tr');

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: "Anda yakin ingin menghapus jadwal ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    table.row(row).remove().draw();
                    Swal.fire(
                        'Dihapus!',
                        'Jadwal berhasil dihapus.',
                        'success'
                    );
                }
            });
            });
            });
            </script>
        </div>
    </div>
        
        <!--Content body end-->

<?php
require_once '../../layout/footer.php';
?>
