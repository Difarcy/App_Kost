<?php
namespace App\Controllers;

class Beranda extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        // Kamar yang hampir jatuh tempo bayar (tgl_masuk dalam 3 hari ke depan dari hari ini)
        $hampirJatuhTempo = $db->query('
            SELECT k.nomor AS nomor_kamar, p.nama AS nama_penghuni, p.tgl_masuk
            FROM tb_kmr_penghuni kp
            JOIN tb_kamar k ON k.id = kp.id_kamar
            JOIN tb_penghuni p ON p.id = kp.id_penghuni
            WHERE kp.tgl_keluar IS NULL
              AND DATEDIFF(p.tgl_masuk + INTERVAL DAY(NOW())-DAY(p.tgl_masuk) + 1 DAY, NOW()) BETWEEN 0 AND 3
        ')->getResultArray();

        // Kamar yang terlambat bayar (ada tagihan bulan ini yang belum lunas)
        $terlambatBayar = $db->query('
            SELECT k.nomor AS nomor_kamar, p.nama AS nama_penghuni, t.bulan
            FROM tb_tagihan t
            JOIN tb_kmr_penghuni kp ON kp.id = t.id_kmr_penghuni
            JOIN tb_kamar k ON k.id = kp.id_kamar
            JOIN tb_penghuni p ON p.id = kp.id_penghuni
            LEFT JOIN tb_bayar b ON b.id_tagihan = t.id
            WHERE t.bulan = DATE_FORMAT(NOW(), "%Y-%m-01")
              AND (b.id IS NULL OR b.status != "lunas")
        ')->getResultArray();

        return view('beranda', [
            'hampirJatuhTempo' => $hampirJatuhTempo,
            'terlambatBayar' => $terlambatBayar,
        ]);
    }
}
