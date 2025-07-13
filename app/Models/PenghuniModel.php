<?php
namespace App\Models;

use CodeIgniter\Model;

class PenghuniModel extends Model
{
    protected $table = 'tb_penghuni';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'no_ktp', 'no_hp', 'tgl_masuk', 'tgl_keluar'];
    protected $useTimestamps = false;
} 