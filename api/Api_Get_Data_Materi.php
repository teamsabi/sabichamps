<?php
header('Content-Type: application/json');
require_once 'conek.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT * FROM materi";
    $result = mysqli_query($GLOBALS['conn'], $query);

    $response = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $response[] = [
                'kode_materi' => $row['kode_materi'],
                'judul_materi' => $row['judul_materi'],
                'mapel' => $row['mapel'],
                'kelas' => $row['kelas'],
                'file_materi_url' => "https://wstif23.myhost.id/kelas_b/team_5/admin/file/" . $row['file_materi'],
                'nama_guru' => $row['nama_guru']
            ];
        }

        echo json_encode([
            'status' => 'success',
            'data' => $response
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to fetch data from database.'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method.'
    ]);
}