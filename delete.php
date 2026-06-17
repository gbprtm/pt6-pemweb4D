<?php
include "koneksi.php";

$id = $_GET["id"];
mysqli_query($koneksi, "DELETE FROM pembalap WHERE id_pembalap = $id");
header("location: dasar.php");
?>