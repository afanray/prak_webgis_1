<?php
// Konfigurasi koneksi database
$dsn = "pgsql:host=localhost;port=5436;dbname=gis_db;user=postgres;password=1234567890";
try {
    $pdo = new PDO($dsn);
    // Atur mode error PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}
