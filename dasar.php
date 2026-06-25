<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracker Pembalap</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h2>Tambah Pembalap</h2>
            <form action="action.php" method="post">
                <label for="nama_pembalap">Nama Pembalap</label>
                <input type="text" name="nama_pembalap" id="nama_pembalap" required>
                
                <label for="nomor">Nomor Kendaraan</label>
                <input type="number" name="nomor" id="nomor" min="0" required>
                
                <label for="tim">Tim / Konstruktor</label>
                <input type="text" name="tim" id="tim" required>
                
                <label for="negara">Negara Asal</label>
                <input type="text" name="negara" id="negara" required>
                
                <input type="submit" value="Tambah Pembalap" name="tambah_pembalap">
            </form>
        </div>

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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'koneksi.php';
                        $sql = "SELECT * FROM pembalap ORDER BY total_poin DESC, nama_pembalap ASC";
                        $cek = mysqli_query($koneksi, $sql);
                        
                        // Cek data 
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
                            <td class="action-links">
                                <a href="update.php?id=<?= $data['id_pembalap'] ?>" class="btn-update">Update</a>
                                <a href="action.php?aksi=hapus_pembalap&id=<?= $data['id_pembalap'] ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus data pembalap ini?');">Delete</a>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo "<tr><td colspan='6' style='text-align:center;'>Belum ada data pembalap</td></tr>";
                        }
                        ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>