<?php
namespace App\Models;

use CodeIgniter\Model;

class BayarModel extends Model
{
    protected $table = 'tb_bayar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_tagihan', 'jml_bayar', 'status'];
    protected $useTimestamps = false;
} 