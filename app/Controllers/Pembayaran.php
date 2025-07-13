<?php
namespace App\Controllers;

use App\Models\BayarModel;
use CodeIgniter\HTTP\ResponseInterface;

class Pembayaran extends BaseController
{
    protected $bayarModel;
    public function __construct()
    {
        $this->bayarModel = new BayarModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_bayar b')
            ->select('b.id, b.jml_bayar, b.status, b.tgl_bayar, t.bulan, t.jml_tagihan, p.nama as nama_penghuni')
            ->join('tb_tagihan t', 't.id = b.id_tagihan')
            ->join('tb_kmr_penghuni kp', 'kp.id = t.id_kmr_penghuni')
            ->join('tb_penghuni p', 'p.id = kp.id_penghuni');
        $data['pembayaran'] = $builder->get()->getResultArray();
        return view('pembayaran', $data);
    }

    public function show($id)
    {
        $data['pembayaran'] = $this->bayarModel->find($id);
        return view('admin/pembayaran/show', $data);
    }

    public function create()
    {
        return view('admin/pembayaran/create');
    }

    public function store()
    {
        $this->bayarModel->save($this->request->getPost());
        return redirect()->to('/admin/pembayaran');
    }

    public function edit($id)
    {
        $data['pembayaran'] = $this->bayarModel->find($id);
        return view('admin/pembayaran/edit', $data);
    }

    public function update($id)
    {
        $this->bayarModel->update($id, $this->request->getPost());
        return redirect()->to('/admin/pembayaran');
    }

    public function delete($id)
    {
        $this->bayarModel->delete($id);
        return redirect()->to('/admin/pembayaran');
    }
} 