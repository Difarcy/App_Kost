<?php
namespace App\Models;

use CodeIgniter\Model;

class BrngBawaanModel extends Model
{
    protected $table = 'tb_brng_bawaan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_penghuni', 'id_barang'];
    protected $useTimestamps = false;
} 