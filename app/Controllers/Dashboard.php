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
        $kamarModel = new KamarModel();
        $penghuniModel = new PenghuniModel();
        $tagihanModel = new TagihanModel();
        $bayarModel = new BayarModel();
        $barangModel = new BarangModel();

        $data = [
            'totalKamar' => $kamarModel->countAllResults(),
            'totalPenghuni' => $penghuniModel->countAllResults(),
            'totalTagihan' => $tagihanModel->countAllResults(),
            'totalPembayaran' => $bayarModel->countAllResults(),
            'totalBarang' => $barangModel->countAllResults(),
            'kamarTerbaru' => $kamarModel->orderBy('id', 'DESC')->findAll(5),
            'penghuniTerbaru' => $penghuniModel->orderBy('id', 'DESC')->findAll(5),
            'tagihanTerbaru' => $tagihanModel->orderBy('id', 'DESC')->findAll(5),
            'pembayaranTerbaru' => $bayarModel->orderBy('id', 'DESC')->findAll(5),
            'barangTerbaru' => $barangModel->orderBy('id', 'DESC')->findAll(5),
        ];
        return view('dashboard', $data);
    }
} 