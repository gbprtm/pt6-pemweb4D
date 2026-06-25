<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pembalap</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="flex-center">
    <?php
    include 'koneksi.php';
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($koneksi, $_GET['id']);
        $ambil = mysqli_query($koneksi, "SELECT * FROM pembalap WHERE id_pembalap = '$id'");
        
        if($edit = mysqli_fetch_array($ambil)) {    
    ?>
    <div class="form-card">
        <h2>Update Pembalap</h2>
        <form action="action.php" method="post">
            <input type="hidden" name="id_pembalap" value="<?= htmlspecialchars($edit['id_pembalap']) ?>">
            
            <label for="nama_pembalap">Nama Pembalap</label>
            <input type="text" name="nama_pembalap" id="nama_pembalap" value="<?= htmlspecialchars($edit['nama_pembalap']) ?>" required>
            
            <label for="nomor">Nomor Kendaraan</label>
            <input type="number" name="nomor" id="nomor" value="<?= htmlspecialchars($edit['nomor']) ?>" min="0" required>
            
            <label for="tim">Tim / Konstruktor</label>
            <input type="text" name="tim" id="tim" value="<?= htmlspecialchars($edit['tim']) ?>" required>
            
            <label for="negara">Negara Asal</label>
            <input type="text" name="negara" id="negara" value="<?= htmlspecialchars($edit['negara']) ?>" required>
            
            <input type="submit" value="Update Pembalap" name="edit_pembalap">
            <a href="dasar.php" class="btn-back">Kembali ke Klasemen</a>
        </form>
    </div>
    <?php 
        } else {
            echo "<div class='form-card'><h2 class='error-message'>Data pembalap tidak ditemukan</h2><a href='dasar.php' class='btn-back'>Kembali ke Klasemen</a></div>";
        }
    } 
    ?>    
</body>
</html>