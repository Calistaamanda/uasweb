<?php
// Koneksi ke database
$koneksi = mysqli_connect("hostname", "username", "password", "database");

// Cek koneksi
if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query mendapatkan notifikasi yang belum dibaca
$sql = "SELECT * FROM notifikasi WHERE status = 'unread'";
$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data setiap baris
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["id"]. " - Title: " . $row["title"]. " " . $row["message"]. "<br>";
    }
} else {
    echo "Tidak ada notifikasi baru.";
}

mysqli_close($koneksi);
?>