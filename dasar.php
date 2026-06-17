<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracker Pembalap</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #42614d;
            margin: 0;
            padding: 40px 20px;
            color: #333;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 40px;
        }
        
        .form-card, .table-card {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .form-card {
            max-width: 400px;
            margin: 0 auto;
            width: 100%;
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
        
        input[type="number"]:focus,
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
        }
        
        input[type="submit"]:hover {
            background-color: #2b4033;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(43, 64, 51, 0.3);
        }
        
        /* Styling Table */
        .table-responsive {
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
            font-size: 15px;
        }
        
        th {
            background-color: #f8faf9;
            color: #42614d;
            font-weight: 600;
        }
        
        tr:hover td {
            background-color: #fcfcfc;
        }
        
        .action-links {
            display: flex;
            gap: 8px;
        }
        
        .action-links a {
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .btn-update {
            background-color: #e3f2fd;
            color: #1976d2;
        }
        
        .btn-update:hover {
            background-color: #bbdefb;
        }
        
        .btn-delete {
            background-color: #ffebee;
            color: #c62828;
        }
        
        .btn-delete:hover {
            background-color: #ffcdd2;
        }
        
        .badge-poin {
            background-color: #e8f5e9;
            color: #2e7d32;
            padding: 4px 8px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Section Form Create -->
        <div class="form-card">
            <h2>Tambah Pembalap</h2>
            <form action="output_dasar.php" method="post">
                <label for="nama_pembalap">Nama Pembalap</label>
                <input type="text" name="nama_pembalap" id="nama_pembalap" required>
                
                <label for="nomor">Nomor Kendaraan</label>
                <input type="number" name="nomor" id="nomor" required>
                
                <label for="tim">Tim / Konstruktor</label>
                <input type="text" name="tim" id="tim" required>
                
                <label for="negara">Negara Asal</label>
                <input type="text" name="negara" id="negara" required>
                
                <input type="submit" value="Tambah Pembalap" name="tambah_data">
            </form>
        </div>

        <!-- Section Table Read -->
        <div class="table-card">
            <h2>Klasemen Pembalap</h2>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Pos</th>
                            <th>Nama Pembalap</th>
                            <th>No</th>
                            <th>Tim</th>
                            <th>Negara</th>
                            <th>Total Poin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'koneksi.php';
                        $sql = "SELECT * FROM pembalap ORDER BY total_poin DESC, nama_pembalap ASC";
                        $cek = mysqli_query($koneksi, $sql);
                        
                        // Cek jika data tersedia
                        if(mysqli_num_rows($cek) > 0) {
                            $posisi = 1;
                            while($data = mysqli_fetch_array($cek)){
                        ?>
                        <tr>
                            <td><strong><?= $posisi++ ?></strong></td>
                            <td><?= htmlspecialchars($data['nama_pembalap']) ?></td>
                            <td><?= htmlspecialchars($data['nomor']) ?></td>
                            <td><?= htmlspecialchars($data['tim']) ?></td>
                            <td><?= htmlspecialchars($data['negara']) ?></td>
                            <td><span class="badge-poin"><?= htmlspecialchars($data['total_poin']) ?> pts</span></td>
                            <td class="action-links">
                                <a href="update.php?id=<?= $data['id_pembalap'] ?>" class="btn-update">Update</a>
                                <a href="delete.php?id=<?= $data['id_pembalap'] ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus data pembalap ini?');">Delete</a>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo "<tr><td colspan='7' style='text-align:center;'>Belum ada data pembalap</td></tr>";
                        }
                        ?> 
                    </tbody>
                </table>
            </div>
        </div>
<!-- Section Form Create Jadwal Balapan -->
        <div class="form-card">
            <h2>Tambah Jadwal Balapan</h2>
            <form action="tambah_jadwal.php" method="post">
                <label for="id_sirkuit">Sirkuit</label>
                <select name="id_sirkuit" id="id_sirkuit" required style="width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; font-family: 'Inter', sans-serif;">
                    <option value="">Pilih Sirkuit</option>
                    <?php
                    $sirkuit_query = mysqli_query($koneksi, "SELECT * FROM sirkuit");
                    while($s = mysqli_fetch_array($sirkuit_query)){
                        echo "<option value='".$s['id_sirkuit']."'>".$s['nama_sirkuit']." (".$s['negara'].")</option>";
                    }
                    ?>
                </select>
                
                <label for="nama_event">Nama Event (GP)</label>
                <input type="text" name="nama_event" id="nama_event" required placeholder="Contoh: GP Mandalika 2026">
                
                <label for="tanggal">Tanggal Balapan</label>
                <input type="date" name="tanggal" id="tanggal" required>
                
                <label for="waktu_start">Waktu Start</label>
                <input type="time" name="waktu_start" id="waktu_start" required style="width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; font-family: 'Inter', sans-serif;">
                
                <input type="submit" value="Tambah Jadwal" name="tambah_jadwal">
            </form>
        </div>

        <!-- Section Table Read Jadwal Balapan -->
        <div class="table-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h2 style="margin: 0;">Jadwal Balapan</h2>
                <a href="hasil_balapan.php" style="background-color: #f5b041; color: #fff; padding: 10px 15px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: all 0.3s;">
                    + Input Hasil Balapan
                </a>
            </div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Event</th>
                            <th>Sirkuit</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $jadwal_sql = "SELECT j.*, s.nama_sirkuit, s.negara FROM jadwal_balapan j 
                                       JOIN sirkuit s ON j.id_sirkuit = s.id_sirkuit ORDER BY j.tanggal ASC";
                        $cek_jadwal = mysqli_query($koneksi, $jadwal_sql);
                        
                        if(mysqli_num_rows($cek_jadwal) > 0) {
                            while($jdwl = mysqli_fetch_array($cek_jadwal)){
                                // Badge warna untuk status
                                $status_color = "#ccc";
                                if($jdwl['status'] == 'Terjadwal') $status_color = "#3498db";
                                if($jdwl['status'] == 'Sedang Berlangsung') $status_color = "#f39c12";
                                if($jdwl['status'] == 'Selesai') $status_color = "#2ecc71";
                                if($jdwl['status'] == 'Dibatalkan') $status_color = "#e74c3c";
                        ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($jdwl['nama_event']) ?></strong></td>
                            <td><?= htmlspecialchars($jdwl['nama_sirkuit']) ?>, <?= htmlspecialchars($jdwl['negara']) ?></td>
                            <td><?= date('d M Y', strtotime($jdwl['tanggal'])) ?></td>
                            <td><?= date('H:i', strtotime($jdwl['waktu_start'])) ?></td>
                            <td><span style="background-color: <?= $status_color ?>; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 600;"><?= $jdwl['status'] ?></span></td>
                            <td class="action-links">
                                <a href="update_jadwal.php?id=<?= $jdwl['id_jadwal'] ?>" class="btn-update">Update</a>
                                <a href="hapus_jadwal.php?id=<?= $jdwl['id_jadwal'] ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus jadwal ini?');">Delete</a>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo "<tr><td colspan='6' style='text-align:center;'>Belum ada jadwal balapan</td></tr>";
                        }
                        ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>