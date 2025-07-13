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