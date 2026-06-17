<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Jadwal Balapan</title>
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
        
        input[type="text"],
        input[type="date"],
        input[type="time"],
        select {
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
        
        input[type="text"]:focus,
        input[type="date"]:focus,
        input[type="time"]:focus,
        select:focus {
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
        $ambil = mysqli_query($koneksi, "SELECT * FROM jadwal_balapan WHERE id_jadwal = '$id'");
        
        if($edit = mysqli_fetch_array($ambil)) {    
    ?>
    <div class="form-card">
        <h2>Update Jadwal</h2>
        <form action="" method="post">
            <input type="hidden" name="id_jadwal" value="<?= htmlspecialchars($edit['id_jadwal']) ?>">
            
            <label for="id_sirkuit">Sirkuit</label>
            <select name="id_sirkuit" id="id_sirkuit" required>
                <?php
                $sirkuit_query = mysqli_query($koneksi, "SELECT * FROM sirkuit");
                while($s = mysqli_fetch_array($sirkuit_query)){
                    $selected = ($s['id_sirkuit'] == $edit['id_sirkuit']) ? "selected" : "";
                    echo "<option value='".$s['id_sirkuit']."' $selected>".$s['nama_sirkuit']." (".$s['negara'].")</option>";
                }
                ?>
            </select>
            
            <label for="nama_event">Nama Event</label>
            <input type="text" name="nama_event" id="nama_event" value="<?= htmlspecialchars($edit['nama_event']) ?>" required>
            
            <label for="tanggal">Tanggal Balapan</label>
            <input type="date" name="tanggal" id="tanggal" value="<?= htmlspecialchars($edit['tanggal']) ?>" required>
            
            <label for="waktu_start">Waktu Start</label>
            <input type="time" name="waktu_start" id="waktu_start" value="<?= htmlspecialchars($edit['waktu_start']) ?>" required>
            
            <label for="status">Status</label>
            <select name="status" id="status" required>
                <option value="Terjadwal" <?= ($edit['status'] == 'Terjadwal') ? 'selected' : '' ?>>Terjadwal</option>
                <option value="Sedang Berlangsung" <?= ($edit['status'] == 'Sedang Berlangsung') ? 'selected' : '' ?>>Sedang Berlangsung</option>
                <option value="Selesai" <?= ($edit['status'] == 'Selesai') ? 'selected' : '' ?>>Selesai</option>
                <option value="Dibatalkan" <?= ($edit['status'] == 'Dibatalkan') ? 'selected' : '' ?>>Dibatalkan</option>
            </select>
            
            <input type="submit" value="Update Jadwal" name="edit_jadwal">
            <a href="dasar.php" class="btn-back">Kembali ke Dashboard</a>
        </form>
    </div>
    <?php 
        } else {
            echo "<div class='form-card'><h2 style='color:#c62828; text-align:center;'>Data jadwal tidak ditemukan</h2><a href='dasar.php' class='btn-back'>Kembali ke Dashboard</a></div>";
        }
    } 
    ?>    

    <?php
    if (isset($_POST['edit_jadwal'])) {
        $id_jadwal = $_POST['id_jadwal'];
        $id_sirkuit = $_POST['id_sirkuit'];
        $nama_event = $_POST['nama_event'];
        $tanggal = $_POST['tanggal'];
        $waktu_start = $_POST['waktu_start'];
        $status = $_POST['status'];

        $query = "UPDATE jadwal_balapan SET id_sirkuit='$id_sirkuit', nama_event='$nama_event', tanggal='$tanggal', waktu_start='$waktu_start', status='$status' WHERE id_jadwal='$id_jadwal'";

        if (mysqli_query($koneksi, $query)) {
            echo "<script> alert('Jadwal Berhasil Di Update!'); window.location.href='dasar.php'; </script>";
        } else {
            echo "<script> alert('Gagal mengupdate jadwal!'); </script>";
        }
    }
    ?>
</body>
</html>
