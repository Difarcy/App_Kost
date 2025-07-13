<?php
namespace App\Models;

use CodeIgniter\Model;

class TagihanModel extends Model
{
    protected $table = 'tb_tagihan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['bulan', 'id_kmr_penghuni', 'jml_tagihan'];
    protected $useTimestamps = false;
} 