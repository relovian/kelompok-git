<?php
session_start();

// Jika belum login, redirect ke halaman login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

require_once '../config/database.php';

$user_id = $_SESSION['user_id'];

// Ambil semua tasks milik user yang login
$query = "SELECT id, title, description, is_completed, due_date FROM tasks WHERE user_id = ? ORDER BY is_completed ASC, due_date ASC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$tasks = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="app-container">
        <header class="app-header">
            <h1>Todo List</h1>
            <div class="user-info">
                <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="../auth/logout.php" class="btn btn-secondary">Logout</a>
            </div>
        </header>

        <main class="app-main">
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php
                    echo htmlspecialchars($_SESSION['success']);
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <?php
                    echo htmlspecialchars($_SESSION['error']);
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <div class="todo-input-section">
                <form id="todoForm" action="../tasks/tambah_task.php" method="POST">
                    <input type="text" id="todoInput" name="title" placeholder="Tambahkan tugas baru..." required>
                    <input type="text" id="todoDescription" name="description" placeholder="Deskripsi (opsional)">
                    <input type="datetime-local" id="todoDueDate" name="due_date">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>

            <div class="todo-filters">
                <button class="filter-btn active">Semua</button>
                <button class="filter-btn">Aktif</button>
                <button class="filter-btn">Selesai</button>
            </div>

            <ul class="todo-list">
                <?php if (count($tasks) > 0): ?>
                    <?php foreach ($tasks as $task): ?>
                        <li class="todo-item <?php echo $task['is_completed'] ? 'completed' : ''; ?>">
                            <form action="../tasks/update_task.php" method="POST" class="todo-checkbox-form">
                                <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                                <input type="hidden" name="is_completed" value="<?php echo $task['is_completed'] ? 0 : 1; ?>">
                                <button type="submit" class="todo-checkbox-btn" title="<?php echo $task['is_completed'] ? 'Tandai belum selesai' : 'Tandai selesai'; ?>">
                                    <?php echo $task['is_completed'] ? '☑' : '☐'; ?>
                                </button>
                            </form>
                            <div class="todo-content">
                                <span class="todo-text"><?php echo htmlspecialchars($task['title']); ?></span>
                                <?php if (!empty($task['description'])): ?>
                                    <span class="todo-description"><?php echo htmlspecialchars($task['description']); ?></span>
                                <?php endif; ?>
                                <?php if (!empty($task['due_date'])): ?>
                                    <span class="todo-due-date">📅 <?php echo date('d M Y H:i', strtotime($task['due_date'])); ?></span>
                                <?php endif; ?>
                            </div>
                            <form action="../tasks/hapus_task.php" method="POST" class="todo-delete-form" onsubmit="return confirm('Yakin ingin menghapus tugas ini?');">
                                <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                                <button type="submit" class="todo-delete" title="Hapus tugas">🗑️</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="todo-item todo-empty">
                        <span class="todo-text">Belum ada tugas. Tambahkan tugas baru di atas!</span>
                    </li>
                <?php endif; ?>
            </ul>
        </main>
    </div>
</body>
</html>