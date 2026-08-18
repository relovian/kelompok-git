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
    $is_completed = isset($_POST['is_completed']) ? 1 : 0;

    // Update status task hanya milik user yang login
    $query = "UPDATE tasks SET is_completed = ? WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iii", $is_completed, $task_id, $user_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Status tugas berhasil diperbarui!";
        header("Location: ../view/index.php");
        exit();
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat memperbarui tugas. Coba lagi.";
        header("Location: ../view/index.php");
        exit();
    }
} else {
    // Jika bukan method POST, redirect ke halaman index
    header("Location: ../view/index.php");
    exit();
}
?>