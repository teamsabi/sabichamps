<?php
// Contoh data siswa
$siswa = [
    [
        "nama" => "Aisyah Rahma",
        "kelas" => "12 IPA",
        "mapel" => [
            ["nama" => "Matematika", "nilai" => 85],
            ["nama" => "Fisika", "nilai" => 78],
            ["nama" => "Kimia", "nilai" => 88],
        ],
    ],
    [
        "nama" => "Budi Santoso",
        "kelas" => "11 IPS",
        "mapel" => [
            ["nama" => "Sejarah", "nilai" => 82],
            ["nama" => "Geografi", "nilai" => 75],
            ["nama" => "Sosiologi", "nilai" => 90],
        ],
    ],
];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Raport Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Dashboard Raport Siswa</h1>
        <?php foreach ($siswa as $data): ?>
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <h4><?= htmlspecialchars($data['nama']); ?> - <?= htmlspecialchars($data['kelas']); ?></h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['mapel'] as $mapel): ?>
                                <tr>
                                    <td><?= htmlspecialchars($mapel['nama']); ?></td>
                                    <td><?= htmlspecialchars($mapel['nilai']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
