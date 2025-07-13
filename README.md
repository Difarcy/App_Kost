# Aplikasi Pengelolaan KostKu

Aplikasi ini adalah sistem manajemen kost berbasis web yang dibangun dengan CodeIgniter 4. Digunakan untuk mengelola data penghuni, kamar, barang, tagihan, pembayaran, dan relasi antar data di lingkungan kost.

## Fitur Utama

- **Manajemen Penghuni Kost**: CRUD data penghuni (nama, KTP, HP, tanggal masuk, tanggal keluar)
- **Manajemen Kamar**: CRUD data kamar (nomor kamar, harga sewa)
- **Manajemen Barang**: CRUD data barang (nama barang, harga) untuk barang yang dikenai biaya tambahan
- **Relasi Kamar-Penghuni**: Catat kamar yang ditempati penghuni, tanggal masuk & keluar
- **Barang Bawaan Penghuni**: Catat barang bawaan penghuni
- **Tagihan Otomatis**: Tagihan bulanan otomatis, jumlah = harga kamar + harga barang bawaan
- **Pembayaran**: Catat pembayaran, status lunas/cicil, dan riwayat pembayaran
- **Pindah Kamar & Keluar Kost**: Update otomatis tanggal keluar kamar/penghuni
- **Dashboard Admin**: Statistik kamar, penghuni, tagihan, pembayaran, grafik pendapatan
- **Halaman Depan**: Info kamar kosong, kamar hampir jatuh tempo bayar, kamar terlambat bayar
- **Export, Print, Modal Modern**: Semua aksi utama menggunakan modal modern, print preview hanya tabel
- **Pencarian, Filter, Pagination**: Semua tabel utama mendukung pencarian, filter, dan pagination

## Struktur Database

- **tb_penghuni** (id, nama, no_ktp, no_hp, tgl_masuk, tgl_keluar)
- **tb_kamar** (id, nomor, harga)
- **tb_barang** (id, nama, harga)
- **tb_kmr_penghuni** (id, id_kamar, id_penghuni, tgl_masuk, tgl_keluar)
- **tb_brng_bawaan** (id, id_penghuni, id_barang)
- **tb_tagihan** (id, bulan, id_kmr_penghuni, jml_tagihan)
- **tb_bayar** (id, id_tagihan, jml_bayar, status)

## Instalasi

1. **Clone repository**
2. **Install dependency**
   ```bash
   composer install
   ```
3. **Copy file env ke .env**
   ```bash
   cp env .env
   ```
4. **Atur koneksi database** di file `.env` (DB hostname, username, password, database)
5. **Import database**
   - Import file `database.sql` ke MySQL Anda
6. **Jalankan server**
   ```bash
   php spark serve
   ```
7. **Akses aplikasi**
   - Halaman depan: `http://localhost:8080/`
   - Admin: `http://localhost:8080/login` (login sebagai admin)

## Akun Admin Default
- Username dan password admin dapat diatur di database (lihat tabel user jika ada)

## Catatan Penting
- Pastikan folder `writable/` dapat ditulis oleh web server
- Semua file asset (CSS, JS, gambar) ada di folder `public/assets/`
- Untuk keamanan, pastikan web server mengarah ke folder `public/`

## Lisensi
Aplikasi ini menggunakan lisensi MIT. Lihat file LICENSE untuk detail.

---

Aplikasi ini dikembangkan untuk memenuhi kebutuhan pengelolaan kost modern, mudah digunakan, dan siap dikembangkan lebih lanjut.
