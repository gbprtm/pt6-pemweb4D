<?php
include 'koneksi.php';


// Tambah Pembalap
if(isset($_POST['tambah_pembalap'])){ 
    $nama_pembalap = $_POST['nama_pembalap']; 
    $nomor = $_POST['nomor']; 
    $tim = $_POST['tim']; 
    $negara = $_POST['negara']; 

    $query = "INSERT INTO pembalap (nama_pembalap, nomor, tim, negara) 
              VALUES ('$nama_pembalap', '$nomor', '$tim', '$negara')"; 

    if(mysqli_query($koneksi, $query)){
        echo "<script>alert('Data Pembalap ditambahkan!'); window.location.href='dasar.php';</script>";
    } else {
        echo "<script>alert('Data gagal ditambahkan!'); window.location.href='dasar.php';</script>";
    }
}

// Edit Pembalap
if (isset($_POST['edit_pembalap'])) {
    $id_pembalap = $_POST['id_pembalap'];
    $nama_pembalap = $_POST['nama_pembalap'];
    $nomor = $_POST['nomor'];
    $tim = $_POST['tim'];
    $negara = $_POST['negara'];

    $query = "UPDATE pembalap SET nama_pembalap='$nama_pembalap', nomor='$nomor', tim='$tim', negara='$negara' WHERE id_pembalap='$id_pembalap'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script> alert('Data Pembalap Berhasil Di Update!'); window.location.href='dasar.php'; </script>";
    } else {
        echo "<script> alert('Gagal mengupdate data pembalap!'); window.location.href='dasar.php'; </script>";
    }
}

// Hapus Pembalap
if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus_pembalap' && isset($_GET['id'])){
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM pembalap WHERE id_pembalap = $id");
    header("location: dasar.php");
    exit();
}

?>

