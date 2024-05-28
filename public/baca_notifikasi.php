<?php
// Koneksi ke database
$koneksi = mysqli_connect("hostname", "username", "password", "database");

// Cek koneksi
if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

// ID notifikasi yang dibaca
$notificationId = $_GET['id'];

// Query mengubah status notifikasi menjadi 'read'
$sql = "UPDATE notifikasi SET status = 'read' WHERE id = $notificationId";

if (mysqli_query($koneksi, $sql)) {
    echo "Notifikasi telah dibaca.";
} else {
    echo "Error updating record: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>