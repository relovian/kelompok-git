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
            <form id="registerForm" action="login.html" method="GET">
                <div class="form-group">
                    <label for="registerName">Nama Lengkap</label>
                    <input type="text" id="registerName" name="name" placeholder="Masukkan nama lengkap" required>
                </div>
                <div class="form-group">
                    <label for="registerEmail">Email</label>
                    <input type="email" id="registerEmail" name="email" placeholder="Masukkan email" required>
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
                Sudah punya akun? <a href="login.html">Login di sini</a>
            </p>
        </div>
    </div>
</body>
</html>