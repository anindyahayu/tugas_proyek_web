<?php

$koneksi = mysqli_connect(
    "localhost",
    "root",
    "",
    "TugasProyek"
);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

