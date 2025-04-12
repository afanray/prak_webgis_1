<?php
// Include file koneksi database
include 'db_connect.php';

// Query untuk menghasilkan data GeoJSON
$query = "SELECT json_build_object(
    'type', 'FeatureCollection',
    'features', json_agg(json_build_object(
        'type', 'Feature',
        'geometry', ST_AsGeoJSON(lokasi)::json,
        'properties', json_build_object(
            'id', id,
            'nama_sekolah', nama_sekolah
        )
    ))
) AS geojson FROM lokasi_sekolah";

try {
    $result = $pdo->query($query)->fetch(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo $result['geojson'];
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
