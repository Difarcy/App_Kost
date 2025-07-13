-- Database: app_kost
-- Aplikasi Pengelolaan Kost

-- Membuat database
CREATE DATABASE IF NOT EXISTS app_kost;
USE app_kost;

-- 1. Tabel penghuni kost
CREATE TABLE tb_penghuni (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    no_ktp VARCHAR(16) UNIQUE NOT NULL,
    no_hp VARCHAR(15) NOT NULL,
    tgl_masuk DATE NOT NULL,
    tgl_keluar DATE NULL
);

-- 2. Tabel kamar
CREATE TABLE tb_kamar (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nomor VARCHAR(10) UNIQUE NOT NULL,
    harga DECIMAL(10,2) NOT NULL
);

-- 3. Tabel barang (barang tambahan yang dikenai biaya)
CREATE TABLE tb_barang (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    harga DECIMAL(10,2) NOT NULL
);

-- 4. Tabel penghuni menempati kamar
CREATE TABLE tb_kmr_penghuni (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_kamar INT NOT NULL,
    id_penghuni INT NOT NULL,
    tgl_masuk DATE NOT NULL,
    tgl_keluar DATE NULL,
    FOREIGN KEY (id_kamar) REFERENCES tb_kamar(id),
    FOREIGN KEY (id_penghuni) REFERENCES tb_penghuni(id)
);

-- 5. Tabel barang bawaan penghuni
CREATE TABLE tb_brng_bawaan (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_penghuni INT NOT NULL,
    id_barang INT NOT NULL,
    FOREIGN KEY (id_penghuni) REFERENCES tb_penghuni(id),
    FOREIGN KEY (id_barang) REFERENCES tb_barang(id)
);

-- 6. Tabel tagihan
CREATE TABLE tb_tagihan (
    id INT PRIMARY KEY AUTO_INCREMENT,
    bulan DATE NOT NULL, -- Format: YYYY-MM-01 (tanggal 1 setiap bulan)
    id_kmr_penghuni INT NOT NULL,
    jml_tagihan DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_kmr_penghuni) REFERENCES tb_kmr_penghuni(id)
);

-- 7. Tabel pembayaran
CREATE TABLE tb_bayar (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_tagihan INT NOT NULL,
    jml_bayar DECIMAL(10,2) NOT NULL,
    status ENUM('lunas', 'cicil') NOT NULL DEFAULT 'cicil',
    tgl_bayar TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_tagihan) REFERENCES tb_tagihan(id)
);

-- 8. Tabel admin
CREATE TABLE tb_admin (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Insert akun admin
INSERT INTO tb_admin (username, password) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'); 

-- Dummy data untuk tb_penghuni
INSERT INTO tb_penghuni (nama, no_ktp, no_hp, tgl_masuk, tgl_keluar) VALUES
('Budi Santoso', '1234567890123456', '081234567890', '2024-01-10', NULL),
('Siti Aminah', '2345678901234567', '082345678901', '2024-02-15', '2024-06-01'),
('Andi Wijaya', '3456789012345678', '083456789012', '2024-03-01', NULL);

-- Dummy data untuk tb_kamar
INSERT INTO tb_kamar (nomor, harga) VALUES
('A1', 1200000.00),
('A2', 950000.00),
('B1', 1500000.00);

-- Dummy data untuk tb_barang
INSERT INTO tb_barang (nama, harga) VALUES
('Kipas Angin', 50000.00),
('Meja Belajar', 75000.00),
('Lemari', 100000.00);

-- Dummy data untuk tb_kmr_penghuni
INSERT INTO tb_kmr_penghuni (id_kamar, id_penghuni, tgl_masuk, tgl_keluar) VALUES
(1, 1, '2024-01-10', NULL),
(2, 2, '2024-02-15', '2024-06-01'),
(3, 3, '2024-03-01', NULL);

-- Dummy data untuk tb_brng_bawaan
INSERT INTO tb_brng_bawaan (id_penghuni, id_barang) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 1);

-- Dummy data untuk tb_tagihan
INSERT INTO tb_tagihan (bulan, id_kmr_penghuni, jml_tagihan) VALUES
('2024-06-01', 1, 1200000.00),
('2024-06-01', 2, 950000.00),
('2024-06-01', 3, 1500000.00);

-- Dummy data untuk tb_bayar
INSERT INTO tb_bayar (id_tagihan, jml_bayar, status, tgl_bayar) VALUES
(1, 1200000.00, 'lunas', '2024-06-02 10:00:00'),
(2, 950000.00, 'lunas', '2024-06-03 11:00:00'),
(3, 1000000.00, 'cicil', '2024-06-04 12:00:00'); 