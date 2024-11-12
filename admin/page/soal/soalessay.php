<?php
require_once '../../layout/top.php';
 ?>

        <!--Content body start*-->
        <div class="content-body">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Soal Essay</h4>
                            </div>

                            <!-- Button Tambah Soal -->
                            <div class="row mb-3">
                                <div class="col-lg-8 col-12" style="margin-top: -30px; margin-left: 120px;">
                                    <button class="btn btn-success" style="color: #f1f5f8; background-color: #229799; border-color: #229799;" data-toggle="modal" data-target="#addSoal">
                                        <i class="fa fa-plus"></i> Tambah Soal Essay
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="EsaiTable" class="display" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Pertanyaan</th>
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

            <!-- Modal Tambah Soal Esai -->
            <div class="modal fade" id="addSoal" tabindex="-1" role="dialog" aria-labelledby="modalSoalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Tambah Soal Esai</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="formTambahSoal">
                                <div class="form-group">
                                    <label for="pertanyaan">Pertanyaan</label>
                                    <textarea class="form-control" id="pertanyaan" placeholder="Masukkan Pertanyaan" required></textarea>
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

            <!-- JavaScript untuk SweetAlert2 dan Fungsi Form -->
            <script>
                $(document).ready(function () {
                    // Inisialisasi DataTable
                    var table = $('#EsaiTable').DataTable();
                    var currentRow; // Menyimpan baris yang sedang diedit

                    // Tambah Soal Esai
                    $('#formTambahSoal').on('submit', function (e) {
                        e.preventDefault();

                        // Ambil nilai dari inputan
                        var pertanyaan = $('#pertanyaan').val();

                        // Cek jika ada baris yang sedang diedit
                        if (currentRow) {
                            // Update DataTable jika sedang mengedit
                            table.row(currentRow).data([
                                table.rows().count(), // No (otomatis dihitung)
                                pertanyaan, // Pertanyaan
                                `<button class="btn btn-sm btn-primary editBtn"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger deleteBtn"><i class="fa fa-trash"></i></button>`
                            ]).draw();

                            currentRow = null; // Reset currentRow setelah edit
                        } else {
                            // Tambahkan data baru ke DataTable
                            table.row.add([
                                table.rows().count() + 1, // No
                                pertanyaan, // Pertanyaan
                                `<button class="btn btn-sm btn-primary editBtn"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger deleteBtn"><i class="fa fa-trash"></i></button>`
                            ]).draw();
                        }

                        // Tutup modal dan reset form
                        $('#addSoal').modal('hide');
                        $('#formTambahSoal')[0].reset();
                    });

                    // Hapus Soal
                    $('#EsaiTable tbody').on('click', '.deleteBtn', function () {
                        table.row($(this).parents('tr')).remove().draw();
                    });

                    // Edit Soal
                    $('#EsaiTable tbody').on('click', '.editBtn', function () {
                        currentRow = $(this).parents('tr'); // Simpan baris yang sedang diedit

                        var data = table.row(currentRow).data(); // Ambil data dari baris
                        $('#pertanyaan').val(data[1]); // Pertanyaan

                        // Tampilkan modal
                        $('#addSoal').modal('show');
                    });
                });
            </script>
        </div>
        <!--Content body end-->


<?php
require_once '../../layout/footer.php';
?>