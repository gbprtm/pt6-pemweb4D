<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pembalap</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #42614d;
            margin: 0;
            padding: 40px 20px;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            box-sizing: border-box;
        }
        
        .form-card {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }
        
        h2 {
            margin-top: 0;
            color: #42614d;
            font-weight: 600;
            text-align: center;
            margin-bottom: 24px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 14px;
            color: #555;
        }
        
        input[type="number"],
        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
        }
        
        input[type="number"][readonly] {
            background-color: #f5f5f5;
            color: #777;
            cursor: not-allowed;
        }
        
        input[type="number"]:focus:not([readonly]),
        input[type="text"]:focus,
        input[type="date"]:focus {
            border-color: #42614d;
            outline: none;
            box-shadow: 0 0 0 3px rgba(66, 97, 77, 0.1);
        }
        
        input[type="submit"] {
            background-color: #42614d;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
            margin-bottom: 12px;
        }
        
        input[type="submit"]:hover {
            background-color: #2b4033;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(43, 64, 51, 0.3);
        }
        
        .btn-back {
            display: block;
            text-align: center;
            text-decoration: none;
            color: #666;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.2s;
        }
        
        .btn-back:hover {
            color: #42614d;
        }
    </style>
</head>
<body>
    <?php
    include 'koneksi.php';
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($koneksi, $_GET['id']);
        $ambil = mysqli_query($koneksi, "SELECT * FROM pembalap WHERE id_pembalap = '$id'");
        
        if($edit = mysqli_fetch_array($ambil)) {    
    ?>
    <div class="form-card">
        <h2>Update Pembalap</h2>
        <form action="" method="post">
            <input type="hidden" name="id_pembalap" value="<?= htmlspecialchars($edit['id_pembalap']) ?>">
            
            <label for="nama_pembalap">Nama Pembalap</label>
            <input type="text" name="nama_pembalap" id="nama_pembalap" value="<?= htmlspecialchars($edit['nama_pembalap']) ?>" required>
            
            <label for="nomor">Nomor Kendaraan</label>
            <input type="number" name="nomor" id="nomor" value="<?= htmlspecialchars($edit['nomor']) ?>" required>
            
            <label for="tim">Tim / Konstruktor</label>
            <input type="text" name="tim" id="tim" value="<?= htmlspecialchars($edit['tim']) ?>" required>
            
            <label for="negara">Negara Asal</label>
            <input type="text" name="negara" id="negara" value="<?= htmlspecialchars($edit['negara']) ?>" required>
            
            <input type="submit" value="Update Pembalap" name="edit_data">
            <a href="dasar.php" class="btn-back">Kembali ke Klasemen</a>
        </form>
    </div>
    <?php 
        } else {
            echo "<div class='form-card'><h2 style='color:#c62828; text-align:center;'>Data pembalap tidak ditemukan</h2><a href='dasar.php' class='btn-back'>Kembali ke Klasemen</a></div>";
        }
    } 
    ?>    

    <?php
    if (isset($_POST['edit_data'])) {
        $id_pembalap = $_POST['id_pembalap'];
        $nama_pembalap = $_POST['nama_pembalap'];
        $nomor = $_POST['nomor'];
        $tim = $_POST['tim'];
        $negara = $_POST['negara'];

        $query = "UPDATE pembalap SET nama_pembalap='$nama_pembalap', nomor='$nomor', tim='$tim', negara='$negara' WHERE id_pembalap='$id_pembalap'";

        if (mysqli_query($koneksi, $query)) {
            echo "<script> alert('Data Pembalap Berhasil Di Update!'); window.location.href='dasar.php'; </script>";
        } else {
            echo "<script> alert('Gagal mengupdate data pembalap!'); </script>";
        }
    }
    ?>
</body>
</html>