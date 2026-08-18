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
                <span> User</span>
                <a href="login.html" class="btn btn-secondary">Logout</a>
            </div>
        </header>

        <main class="app-main">
            <div class="todo-input-section">
                <form id="todoForm" action="#" method="GET">
                    <input type="text" id="todoInput" name="todo" placeholder="Tambahkan tugas baru..." required>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>

            <div class="todo-filters">
                <button class="filter-btn active">Semua</button>
                <button class="filter-btn">Aktif</button>
                <button class="filter-btn">Selesai</button>
            </div>

            <ul class="todo-list">
                <li class="todo-item">
                    <input type="checkbox" class="todo-checkbox">
                    <span class="todo-text">Belajar HTML & CSS</span>
                    <button class="todo-delete" title="Hapus tugas">🗑️</button>
                </li>
                <li class="todo-item completed">
                    <input type="checkbox" class="todo-checkbox" checked>
                    <span class="todo-text">Membuat desain halaman login</span>
                    <button class="todo-delete" title="Hapus tugas">🗑️</button>
                </li>
                <li class="todo-item">
                    <input type="checkbox" class="todo-checkbox">
                    <span class="todo-text">Belajar JavaScript</span>
                    <button class="todo-delete" title="Hapus tugas">🗑️</button>
                </li>
                <li class="todo-item">
                    <input type="checkbox" class="todo-checkbox">
                    <span class="todo-text">Menyelesaikan tugas kelompok</span>
                    <button class="todo-delete" title="Hapus tugas">🗑️</button>
                </li>
            </ul>
        </main>
    </div>
</body>
</html>