<?php
include 'db_connect.php'; // Pastikan path sudah benar

// Ambil data dari form
$nama = $_POST['fname'] ?? '';
$lat = $_POST['latitude'] ?? '';
$lng = $_POST['longitude'] ?? '';

// Validasi sederhana
if ($nama && $lat && $lng) {
    // Format POINT(lng lat) → karena Geo format pakai lon lat
    $point = "POINT($lng $lat)";

    // Query insert dengan menggunakan PDO
    $query = "INSERT INTO lokasi_sekolah (nama_sekolah, lokasi) 
              VALUES (:nama_sekolah, ST_GeomFromText(:lokasi, 4326))";

    // Menyiapkan statement
    $stmt = $pdo->prepare($query);

    // Bind parameter
    $stmt->bindParam(':nama_sekolah', $nama);
    $stmt->bindParam(':lokasi', $point);

    // Eksekusi query
    try {
        $stmt->execute();
        // Jika berhasil, arahkan kembali ke halaman form
        header("Location: index.html"); // Sesuaikan dengan path halaman form kamu
        exit; // Pastikan script PHP berhenti setelah redirect
    } catch (PDOException $e) {
        echo "Gagal menyimpan data: " . $e->getMessage();
    }
} else {
    echo "Semua data harus diisi!";
}
