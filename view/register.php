<?php
session_start();

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Todo List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Todo List</h1>
                <p>Buat akun baru untuk memulai</p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <form action="../auth/proses_registrasi.php" method="POST">
                <div class="form-group">
                    <label for="registerUsername">Username</label>
                    <input type="text" id="registerUsername" name="username" placeholder="Masukkan username" value="<?php echo isset($_SESSION['old_username']) ? htmlspecialchars($_SESSION['old_username']) : ''; ?>" required>
                    <?php unset($_SESSION['old_username']); ?>
                </div>
                <div class="form-group">
                    <label for="registerPassword">Password</label>
                    <input type="password" id="registerPassword" name="password" placeholder="Masukkan password (min. 6 karakter)" required>
                </div>
                <div class="form-group">
                    <label for="registerConfirmPassword">Konfirmasi Password</label>
                    <input type="password" id="registerConfirmPassword" name="confirm_password" placeholder="Ulangi password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Daftar</button>
            </form>
            <p class="auth-footer">
                Sudah punya akun? <a href="login.php">Login di sini</a>
            </p>
        </div>
    </div>
</body>
</html>