<?php
session_start();

// Jika pengguna belum login, arahkan ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Dapatkan username dari sesi
$username = $_SESSION['username'];
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

  <!-- Ikon -->
  <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="logo">
        <img src="assets/img/logo1.png" alt="Logo SABI">
        <h1></h1>
      </div>
      <nav>
        <ul>
          <li><a href="#"><i class="fas fa-home"></i> Beranda</a></li>
          <li><a href="#"><i class="fas fa-book"></i> Kelas</a></li>
          <li><a href="#"><i class="fas fa-list"></i> Daftar</a></li>
        </ul>
      </nav>
    </div>

    <!-- Konten Utama -->
    <div class="main-content">
      <header>
        <h2>Hai <?php echo htmlspecialchars($username); ?>!</h2> <!-- Tampilkan username pengguna -->
        <div class="search-bar">
          <input type="text" placeholder="Mau Belajar Apa ??">
          <button><i class="fas fa-search"></i></button>
        </div>
        <!-- Tambahkan tombol logout -->
        <a href="logout.php" class="btn btn-danger" style="margin-left: auto; color: white; text-decoration: none;">Logout</a>
      </header>

      <!-- Rectangle (Persegi panjang) -->
      <div class="rectangle">
      
      </div>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>
