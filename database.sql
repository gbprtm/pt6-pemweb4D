CREATE DATABASE IF NOT EXISTS tracker_balapan;
USE tracker_balapan;

CREATE TABLE pembalap (
    id_pembalap INT(11) PRIMARY KEY AUTO_INCREMENT,
    nama_pembalap VARCHAR(100) NOT NULL,
    nomor INT(11) NOT NULL,
    tim VARCHAR(100) NOT NULL,
    negara VARCHAR(50),
    total_poin INT(11) DEFAULT 0
) ENGINE=InnoDB;

CREATE TABLE sirkuit (
    id_sirkuit INT(11) PRIMARY KEY AUTO_INCREMENT,
    nama_sirkuit VARCHAR(100) NOT NULL,
    lokasi VARCHAR(100),
    negara VARCHAR(50),
    panjang_km DECIMAL(5,3)
) ENGINE=InnoDB;

CREATE TABLE jadwal_balapan (
    id_jadwal INT(11) PRIMARY KEY AUTO_INCREMENT,
    id_sirkuit INT(11),
    nama_event VARCHAR(100),
    tanggal DATE,
    waktu_start TIME,
    status ENUM('Terjadwal','Sedang Berlangsung','Selesai','Dibatalkan') DEFAULT 'Terjadwal',
    FOREIGN KEY (id_sirkuit) REFERENCES sirkuit(id_sirkuit)
) ENGINE=InnoDB;

CREATE TABLE hasil_balapan (
    id_hasil INT(11) PRIMARY KEY AUTO_INCREMENT,
    id_jadwal INT(11),
    id_pembalap INT(11),
    posisi INT(11),
    poin INT(11),
    waktu VARCHAR(20),
    fastest_lap BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_jadwal) REFERENCES jadwal_balapan(id_jadwal),
    FOREIGN KEY (id_pembalap) REFERENCES pembalap(id_pembalap)
) ENGINE=InnoDB;

-- Data Dummy Sirkuit
INSERT INTO sirkuit (nama_sirkuit, lokasi, negara, panjang_km) VALUES
('Sirkuit Mandalika', 'Lombok', 'Indonesia', 4.310),
('Sepang International Circuit', 'Selangor', 'Malaysia', 5.543),
('Suzuka Circuit', 'Suzuka', 'Jepang', 5.807),
('Chang International Circuit', 'Buriram', 'Thailand', 4.554);