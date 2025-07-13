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
        $data['pembayaran'] = $this->bayarModel->findAll();
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