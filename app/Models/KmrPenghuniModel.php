<?php
namespace App\Models;

use CodeIgniter\Model;

class KmrPenghuniModel extends Model
{
    protected $table = 'tb_kmr_penghuni';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_kamar', 'id_penghuni', 'tgl_masuk', 'tgl_keluar'];
    protected $useTimestamps = false;
} 