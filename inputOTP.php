<?php
require './admin/helper/koneksi.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['otp_code'], $_POST['id_user'])) {
    try {
        $id_user = $_POST['id_user'];
        $otp_code = $_POST['otp_code'];

        // Validasi input
        if (empty($id_user) || empty($otp_code) || !is_numeric($otp_code) || strlen($otp_code) !== 5) {
            die("<script>alert('ID pengguna atau kode OTP tidak valid.');</script>");
        }

        // Periksa keberadaan ID user dan OTP dalam database
        $query = $koneksi->prepare("
            SELECT otp_code, expires_at, status 
            FROM password_reset 
            WHERE id_user = :id_user AND status = 'pending'
        ");
        $query->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $current_time = date('Y-m-d H:i:s');
            if ($otp_code == $result['otp_code'] && strtotime($current_time) <= strtotime($result['expires_at'])) {
                // Update status OTP menjadi verified
                $updateQuery = $koneksi->prepare("
                    UPDATE password_reset 
                    SET status = 'verified' 
                    WHERE id_user = :id_user AND otp_code = :otp_code
                ");
                $updateQuery->bindParam(':id_user', $id_user, PDO::PARAM_INT);
                $updateQuery->bindParam(':otp_code', $otp_code);
                $updateQuery->execute();

                // Redirect ke halaman reset password
                header("Location: kata_sandibaru.php?id_user=" . urlencode($id_user));
                exit();
            } else {
                die("<script>alert('Kode OTP salah atau sudah kedaluwarsa.');</script>");
            }
        } else {
            die("<script>alert('ID pengguna atau OTP tidak ditemukan.');</script>");
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masukkan Kode OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #239D9F;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }
        .otp-container {
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .otp-container img {
            width: 80px;
            margin-bottom: 15px;
        }
        .otp-container h2 {
            font-weight: 600;
            margin-bottom: 10px;
        }
        .otp-container p {
            color: gray;
            margin-bottom: 20px;
        }
        .otp-inputs input {
            width: 50px;
            height: 60px;
            margin: 0 5px;
            text-align: center;
            font-size: 24px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .otp-actions .btn {
            width: 45%;
            margin: 10px 2%;
            border-radius: 10px;
            background-color: #229799;
            color: white;
            border: none;
        }
        .otp-actions .btn:hover {
            background-color: #1e8888;
        }
        .resend-link {
            margin-top: 10px;
            display: block;
            color: #239D9F;
            text-decoration: none;
            font-weight: 500;
        }
        .resend-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="otp-container">
        <img src="assets/img/email_msg.png" alt="OTP Icon">
        <h2>Masukkan Kode OTP</h2>
        <p>Masukkan 5 digit kode OTP yang sudah kami kirim ke email Anda!</p>
        <form method="POST" action="">
            <input type="hidden" name="id_user" value="<?php echo isset($_GET['id_user']) ? htmlspecialchars($_GET['id_user']) : ''; ?>">
            <div class="otp-inputs d-flex justify-content-center">
                <input type="text" maxlength="1" class="form-control" required>
                <input type="text" maxlength="1" class="form-control" required>
                <input type="text" maxlength="1" class="form-control" required>
                <input type="text" maxlength="1" class="form-control" required>
                <input type="text" maxlength="1" class="form-control" required>
            </div>
            <input type="hidden" name="otp_code" id="otp_code">
            <a href="lupa_password.php" class="resend-link">Belum menerima kode OTP? <strong>Kirim Ulang</strong></a>
            <div class="otp-actions">
                <button type="button" class="btn" onclick="window.history.back()">Kembali</button>
                <button type="submit" class="btn">Kirim</button>
            </div>
        </form>
    </div>
    <script>
        // Script untuk input OTP otomatis berpindah
        document.querySelectorAll('.otp-inputs input').forEach((input, index, inputs) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                } else if (input.value.length === 0 && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });

        // Gabungkan nilai OTP dari semua input sebelum dikirimkan
        document.querySelector("form").addEventListener("submit", function(e) {
            let otpCode = "";
            document.querySelectorAll('.otp-inputs input').forEach(input => otpCode += input.value);
            document.getElementById("otp_code").value = otpCode;
        });
    </script>
</body>
</html>
