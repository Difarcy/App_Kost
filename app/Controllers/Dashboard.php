<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\KamarModel;
use App\Models\PenghuniModel;
use App\Models\TagihanModel;
use App\Models\BayarModel;
use App\Models\BarangModel;

class Dashboard extends Controller
{
    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/login');
        }
        $kamarModel = new \App\Models\KamarModel();
        $penghuniModel = new \App\Models\PenghuniModel();
        $tagihanModel = new \App\Models\TagihanModel();
        $bayarModel = new \App\Models\BayarModel();

        $db = \Config\Database::connect();
        // Grafik pendapatan perbulan (6 bulan terakhir)
        $grafik = $db->query('
            SELECT DATE_FORMAT(t.bulan, "%b %Y") as bulan, SUM(b.jml_bayar) as total
            FROM tb_bayar b
            JOIN tb_tagihan t ON t.id = b.id_tagihan
            GROUP BY YEAR(t.bulan), MONTH(t.bulan)
            ORDER BY t.bulan DESC
            LIMIT 6
        ')->getResultArray();
        $grafik = array_reverse($grafik); // urutkan dari paling lama ke terbaru

        $data = [
            'totalKamar' => $kamarModel->countAllResults(),
            'totalPenghuni' => $penghuniModel->countAllResults(),
            'totalTagihan' => $tagihanModel->countAllResults(),
            'totalPembayaran' => $bayarModel->countAllResults(),
            'grafikPendapatan' => $grafik,
        ];
        return view('dashboard', $data);
    }
} 