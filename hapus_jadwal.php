<?php
include "koneksi.php";

$id = $_GET["id"];
mysqli_query($koneksi, "DELETE FROM jadwal_balapan WHERE id_jadwal = $id");
header("location: dasar.php");
?>
