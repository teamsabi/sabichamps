<?php
// Database connection
define('SERVER', '127.0.0.1');
define('UID', 'root');
define('PASSWORD', '');
define('DB_NAME', 'sab_baru');

// Create connection
$conn = new mysqli(SERVER, UID, PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// Check if 'id_user' parameter is provided
if (!isset($_GET['id_user'])) {
    echo json_encode(['message' => 'id_user parameter not provided.']);
    exit;
}

$id_user = $_GET['id_user'];

// Get schedule data from the database
$sql = "
    SELECT tanggal, k.nama_kelas, m.nama_mapel, u.nama_lengkap 
    FROM jadwal j 
    JOIN kelas k ON j.kode_kelas = k.kode_kelas 
    JOIN mapel m ON j.kode_mapel = m.kode_mapel 
    JOIN kelas_user ku ON k.kode_kelas = ku.kode_kelas 
    JOIN user u ON j.id_user = u.id_user 
    WHERE ku.id_user = '$id_user'";

$result = $conn->query($sql);

// Fetch results
if ($result) {
    $schedules = $result->fetch_all(MYSQLI_ASSOC);
    if ($schedules) {
        echo json_encode(['data' => $schedules]);
    } else {
        echo json_encode(['message' => 'No schedules found.']);
    }
} else {
    echo json_encode(['error' => 'Query error: ' . $conn->error]);
}

// Close the connection
$conn->close();
