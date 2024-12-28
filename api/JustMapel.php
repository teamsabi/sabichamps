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

// Get mapel data from the database
$sql = "
    SELECT DISTINCT m.kode_mapel, m.nama_mapel
    FROM mapel m
    JOIN jadwal j ON m.kode_mapel = j.kode_mapel
    JOIN kelas k ON j.kode_kelas = k.kode_kelas
    JOIN kelas_user ku ON k.kode_kelas = ku.kode_kelas
    WHERE ku.id_user = '$id_user'
";

$result = $conn->query($sql);

// Fetch results
if ($result) {
    $mapels = $result->fetch_all(MYSQLI_ASSOC);
    if ($mapels) {
        echo json_encode(['data' => $mapels]);
    } else {
        echo json_encode(['message' => 'No mapel found for the given user.']);
    }
} else {
    echo json_encode(['error' => 'Query error: ' . $conn->error]);
}

// Close the connection
$conn->close();
