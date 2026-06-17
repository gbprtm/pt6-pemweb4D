<?php
include 'koneksi.php'; 

if(isset($_POST['tambah_data'])){ 
    $nama_pembalap = $_POST['nama_pembalap']; 
    $nomor = $_POST['nomor']; 
    $tim = $_POST['tim']; 
    $negara = $_POST['negara']; 

    $query = "INSERT INTO pembalap (nama_pembalap, nomor, tim, negara) 
              VALUES ('$nama_pembalap', '$nomor', '$tim', '$negara')"; 

    if(mysqli_query($koneksi, $query)){
        echo "<script>alert('Data Pembalap berhasil ditambahkan!'); window.location.href='dasar.php';</script>";
    } else {
        echo "<script>alert('Data gagal ditambahkan!'); window.location.href='dasar.php';</script>";
    }
}
?>