<?php
include 'koneksi.php';

if(isset($_POST['tambah_jadwal'])){
    $id_sirkuit = $_POST['id_sirkuit'];
    $nama_event = $_POST['nama_event'];
    $tanggal = $_POST['tanggal'];
    $waktu_start = $_POST['waktu_start'];
    
    $query = "INSERT INTO jadwal_balapan (id_sirkuit, nama_event, tanggal, waktu_start, status) 
              VALUES ('$id_sirkuit', '$nama_event', '$tanggal', '$waktu_start', 'Terjadwal')";
              
    if(mysqli_query($koneksi, $query)){
        echo "<script>alert('Jadwal Balapan berhasil ditambahkan!'); window.location.href='dasar.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan jadwal balapan!'); window.location.href='dasar.php';</script>";
    }
}
?>
