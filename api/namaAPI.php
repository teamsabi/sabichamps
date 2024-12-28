<?php
include 'connection.php'; // File koneksi database

// Validasi input dari POST
$id_user = isset($_POST['id_user']) ? $_POST['id_user'] : null;

if (!$id_user) {
    // Jika id_user tidak dikirim, beri respons error
    echo json_encode([
        "status" => "error",
        "message" => "id_user tidak diberikan."
    ]);
    exit;
}

// Query untuk mendapatkan nama berdasarkan id_user
$query = "SELECT username FROM user WHERE id_user = ?";
$stmt = $con->prepare($query);

// Cek jika query berhasil dipersiapkan
if ($stmt) {
    // Bind parameter (gunakan "s" untuk tipe string)
    $stmt->bind_param("s", $id_user);

    // Eksekusi query
    $stmt->execute();

    // Ambil hasil
    $result = $stmt->get_result();

    // Cek apakah id_user ditemukan
    if ($result->num_rows > 0) {
        // Ambil nama dari hasil query
        $data = $result->fetch_assoc();

        // Kirimkan nama dalam format JSON
        echo json_encode([
            "status" => "success",
            "nama" => $data['nama']
        ]);
    } else {
        // Jika tidak ditemukan, kirimkan respons error
        echo json_encode([
            "status" => "error",
            "message" => "id_user tidak ditemukan."
        ]);
    }

    // Tutup statement
    $stmt->close();
} else {
    // Jika query gagal dipersiapkan
    echo json_encode([
        "status" => "error",
        "message" => "Query tidak valid."
    ]);
}

// Tutup koneksi database
$con->close();
