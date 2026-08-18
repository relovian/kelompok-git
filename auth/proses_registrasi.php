<?php
session_start();
require_once '../config/database.php';

// Cek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi input tidak kosong
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = "Semua field wajib diisi!";
        header("Location: ../view/register.php");
        exit();
    }

    // Validasi password minimal 6 karakter
    if (strlen($password) < 6) {
        $_SESSION['error'] = "Password minimal 6 karakter!";
        $_SESSION['old_username'] = $username;
        header("Location: ../view/register.php");
        exit();
    }

    // Validasi password dan konfirmasi password sama
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Password dan konfirmasi password tidak sama!";
        $_SESSION['old_username'] = $username;
        header("Location: ../view/register.php");
        exit();
    }

    // Cek apakah username sudah terdaftar
    $check_query = "SELECT id FROM users WHERE username = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Username sudah digunakan!";
        $_SESSION['old_username'] = $username;
        header("Location: ../view/register.php");
        exit();
    }

    // Hash password sebelum disimpan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user baru ke database
    $insert_query = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
        header("Location: ../view/login.php");
        exit();
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat mendaftar. Coba lagi.";
        header("Location: ../view/register.php");
        exit();
    }
} else {
    // Jika bukan method POST, redirect ke halaman register
    header("Location: ../view/register.php");
    exit();
}
?>