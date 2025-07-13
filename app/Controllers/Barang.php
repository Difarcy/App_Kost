<?php
namespace App\Controllers;

use App\Models\BarangModel;
use CodeIgniter\HTTP\ResponseInterface;

class Barang extends BaseController
{
    protected $barangModel;
    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }

    public function index()
    {
        $data['barang'] = $this->barangModel->findAll();
        return view('admin/barang/index', $data);
    }

    public function show($id)
    {
        $data['barang'] = $this->barangModel->find($id);
        return view('admin/barang/show', $data);
    }

    public function create()
    {
        return view('admin/barang/create');
    }

    public function store()
    {
        $this->barangModel->save($this->request->getPost());
        return redirect()->to('/admin/barang');
    }

    public function edit($id)
    {
        $data['barang'] = $this->barangModel->find($id);
        return view('admin/barang/edit', $data);
    }

    public function update($id)
    {
        $this->barangModel->update($id, $this->request->getPost());
        return redirect()->to('/admin/barang');
    }

    public function delete($id)
    {
        $this->barangModel->delete($id);
        return redirect()->to('/admin/barang');
    }
} 