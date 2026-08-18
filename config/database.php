<?php
// File koneksi database

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'ToDoList';

$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>