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
    $task_id = $_POST['task_id'];

    // Hapus task hanya milik user yang login
    $query = "DELETE FROM tasks WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $task_id, $user_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Tugas berhasil dihapus!";
        header("Location: ../view/index.php");
        exit();
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat menghapus tugas. Coba lagi.";
        header("Location: ../view/index.php");
        exit();
    }
} else {
    // Jika bukan method POST, redirect ke halaman index
    header("Location: ../view/index.php");
    exit();
}
?>