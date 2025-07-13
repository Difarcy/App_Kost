<?php
namespace App\Models;

use CodeIgniter\Model;

class KamarModel extends Model
{
    protected $table = 'tb_kamar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nomor', 'harga'];
    protected $useTimestamps = false;
} 