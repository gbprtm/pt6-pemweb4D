<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Hasil Balapan</title>
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
            max-width: 600px;
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
        
        select, input[type="number"] {
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
        
        select:focus, input[type="number"]:focus {
            border-color: #42614d;
            outline: none;
            box-shadow: 0 0 0 3px rgba(66, 97, 77, 0.1);
        }
        
        input[type="submit"] {
            background-color: #f5b041;
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
            margin-top: 20px;
        }
        
        input[type="submit"]:hover {
            background-color: #e67e22;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(230, 126, 34, 0.3);
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
        
        .pembalap-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .pembalap-row input {
            width: 100px;
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="form-card">
        <h2>Input Hasil Balapan</h2>
        
        <?php
        include 'koneksi.php';
        
        // Proses Submit Hasil
        if(isset($_POST['simpan_hasil'])){
            $id_jadwal = $_POST['id_jadwal'];
            $posisi_array = $_POST['posisi']; // Array [id_pembalap => posisi]
            
            $berhasil = 0;
            foreach($posisi_array as $id_pembalap => $posisi) {
                if(!empty($posisi) && is_numeric($posisi) && $posisi > 0) {
                    // Hitung Poin (1=25, 2=18, 3=15, 4=12, 5=10, 6=8, 7=6, 8=4, 9=2, 10=1)
                    $poin = 0;
                    if($posisi == 1) $poin = 25;
                    else if($posisi == 2) $poin = 18;
                    else if($posisi == 3) $poin = 15;
                    else if($posisi == 4) $poin = 12;
                    else if($posisi == 5) $poin = 10;
                    else if($posisi == 6) $poin = 8;
                    else if($posisi == 7) $poin = 6;
                    else if($posisi == 8) $poin = 4;
                    else if($posisi == 9) $poin = 2;
                    else if($posisi == 10) $poin = 1;
                    
                    // Insert ke tabel hasil_balapan
                    $waktu = ""; // Bisa dikembangkan nanti
                    $query_hasil = "INSERT INTO hasil_balapan (id_jadwal, id_pembalap, posisi, poin, waktu) VALUES ('$id_jadwal', '$id_pembalap', '$posisi', '$poin', '$waktu')";
                    
                    if(mysqli_query($koneksi, $query_hasil)) {
                        // Update total poin pembalap
                        $query_update = "UPDATE pembalap SET total_poin = total_poin + $poin WHERE id_pembalap = '$id_pembalap'";
                        mysqli_query($koneksi, $query_update);
                        $berhasil++;
                    }
                }
            }
            
            // Ubah status jadwal menjadi selesai
            mysqli_query($koneksi, "UPDATE jadwal_balapan SET status='Selesai' WHERE id_jadwal='$id_jadwal'");
            
            if($berhasil > 0) {
                echo "<script>alert('Berhasil menyimpan hasil untuk $berhasil pembalap!'); window.location.href='dasar.php';</script>";
            } else {
                echo "<script>alert('Gagal menyimpan atau tidak ada posisi yang valid diisi.');</script>";
            }
        }
        
        // Tampilkan Form
        if (!isset($_GET['id_jadwal'])) {
            // Step 1: Pilih Jadwal
        ?>
            <form action="" method="get">
                <label for="id_jadwal">Pilih Jadwal Balapan</label>
                <select name="id_jadwal" id="id_jadwal" required>
                    <option value="">-- Pilih --</option>
                    <?php
                    $jadwal_sql = "SELECT j.*, s.nama_sirkuit FROM jadwal_balapan j JOIN sirkuit s ON j.id_sirkuit = s.id_sirkuit WHERE j.status != 'Selesai'";
                    $jadwal_query = mysqli_query($koneksi, $jadwal_sql);
                    while($j = mysqli_fetch_array($jadwal_query)){
                        echo "<option value='".$j['id_jadwal']."'>".$j['nama_event']." - ".$j['nama_sirkuit']."</option>";
                    }
                    ?>
                </select>
                <input type="submit" value="Lanjut ke Input Posisi" style="background-color: #42614d;">
                <a href="dasar.php" class="btn-back">Kembali ke Dashboard</a>
            </form>
        <?php
        } else {
            // Step 2: Input Posisi per Pembalap
            $id_jadwal_terpilih = mysqli_real_escape_string($koneksi, $_GET['id_jadwal']);
            $info_jadwal = mysqli_fetch_array(mysqli_query($koneksi, "SELECT nama_event FROM jadwal_balapan WHERE id_jadwal = '$id_jadwal_terpilih'"));
        ?>
            <div style="background-color: #e8f5e9; padding: 15px; border-radius: 8px; margin-bottom: 20px; color: #2e7d32; text-align: center; font-weight: bold;">
                Event: <?= htmlspecialchars($info_jadwal['nama_event']) ?>
            </div>
            
            <form action="" method="post">
                <input type="hidden" name="id_jadwal" value="<?= $id_jadwal_terpilih ?>">
                
                <div style="margin-bottom: 15px; font-size: 14px; color: #777;">Masukkan posisi finish (1, 2, 3...) untuk pembalap. Kosongkan jika DNF/tidak finish.</div>
                
                <?php
                $pembalap_sql = "SELECT * FROM pembalap ORDER BY nama_pembalap ASC";
                $pembalap_query = mysqli_query($koneksi, $pembalap_sql);
                while($p = mysqli_fetch_array($pembalap_query)){
                ?>
                <div class="pembalap-row">
                    <div>
                        <strong><?= htmlspecialchars($p['nama_pembalap']) ?></strong><br>
                        <span style="font-size: 12px; color: #888;"><?= htmlspecialchars($p['tim']) ?> | No: <?= htmlspecialchars($p['nomor']) ?></span>
                    </div>
                    <div>
                        <input type="number" name="posisi[<?= $p['id_pembalap'] ?>]" min="1" max="100" placeholder="Pos">
                    </div>
                </div>
                <?php } ?>
                
                <input type="submit" value="Simpan Hasil & Hitung Poin" name="simpan_hasil">
                <a href="hasil_balapan.php" class="btn-back">Batal & Pilih Event Lain</a>
            </form>
        <?php
        }
        ?>
    </div>
</body>
</html>
