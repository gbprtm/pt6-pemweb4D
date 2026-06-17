<?php
$koneksi = mysqli_connect("localhost", "root", "", "tracker_balapan");

if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}
?>
