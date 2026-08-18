<?php
session_start();
require_once '../config/database.php';

// Cek apakah user sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../view/login.php");
    exit();
}

// Cek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $title = trim($_POST['title']);
    $description = isset($_POST['description']) ? trim($_POST['description']) : null;
    $due_date = isset($_POST['due_date']) && !empty($_POST['due_date']) ? $_POST['due_date'] : null;

    // Validasi input tidak kosong
    if (empty($title)) {
        $_SESSION['error'] = "Judul tugas wajib diisi!";
        header("Location: ../view/index.php");
        exit();
    }

    // Insert task ke database
    $query = "INSERT INTO tasks (user_id, title, description, due_date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isss", $user_id, $title, $description, $due_date);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Tugas berhasil ditambahkan!";
        header("Location: ../view/index.php");
        exit();
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat menambahkan tugas. Coba lagi.";
        header("Location: ../view/index.php");
        exit();
    }
} else {
    // Jika bukan method POST, redirect ke halaman index
    header("Location: ../view/index.php");
    exit();
}
?>