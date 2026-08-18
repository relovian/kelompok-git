<?php
session_start();
require_once '../config/database.php';

// Cek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validasi input tidak kosong
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username dan password wajib diisi!";
        header("Location: ../view/login.php");
        exit();
    }

    // Query user berdasarkan username
    $query = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cek apakah user ditemukan
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Set session login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['logged_in'] = true;

            // Redirect ke dashboard
            header("Location: ../view/index.php");
            exit();
        } else {
            $_SESSION['error'] = "Password salah!";
            $_SESSION['old_username'] = $username;
            header("Location: ../view/login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Username tidak ditemukan!";
        $_SESSION['old_username'] = $username;
        header("Location: ../view/login.php");
        exit();
    }
} else {
    // Jika bukan method POST, redirect ke halaman login
    header("Location: ../view/login.php");
    exit();
}
?>