<?php
// Koneksi ke database
$koneksi = mysqli_connect("hostname", "username", "password", "database");

// Cek koneksi
if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ambil jumlah notifikasi yang belum dibaca
$sql = "SELECT COUNT(*) AS unread_count FROM notifikasi WHERE status = 'unread'";
$result = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_assoc($result);

$response = [
    'unread_count' => $row['unread_count']
];

echo json_encode($response);

mysqli_close($koneksi);
?>
