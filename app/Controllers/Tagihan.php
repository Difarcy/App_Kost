<?php
namespace App\Controllers;

use App\Models\TagihanModel;
use CodeIgniter\HTTP\ResponseInterface;

class Tagihan extends BaseController
{
    protected $tagihanModel;
    public function __construct()
    {
        $this->tagihanModel = new TagihanModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_tagihan t')
            ->select('t.id, t.bulan, t.jml_tagihan, p.nama as nama_penghuni, k.nomor as nomor_kamar')
            ->join('tb_kmr_penghuni kp', 'kp.id = t.id_kmr_penghuni')
            ->join('tb_penghuni p', 'p.id = kp.id_penghuni')
            ->join('tb_kamar k', 'k.id = kp.id_kamar');
        $data['tagihan'] = $builder->get()->getResultArray();
        return view('tagihan', $data);
    }

    public function show($id)
    {
        $data['tagihan'] = $this->tagihanModel->find($id);
        return view('admin/tagihan/show', $data);
    }

    public function create()
    {
        return view('admin/tagihan/create');
    }

    public function store()
    {
        $this->tagihanModel->save($this->request->getPost());
        return redirect()->to('/admin/tagihan');
    }

    public function edit($id)
    {
        $data['tagihan'] = $this->tagihanModel->find($id);
        return view('admin/tagihan/edit', $data);
    }

    public function update($id)
    {
        $this->tagihanModel->update($id, $this->request->getPost());
        return redirect()->to('/admin/tagihan');
    }

    public function delete($id)
    {
        $this->tagihanModel->delete($id);
        return redirect()->to('/admin/tagihan');
    }
} 