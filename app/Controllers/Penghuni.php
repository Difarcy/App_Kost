<?php
namespace App\Controllers;

use App\Models\PenghuniModel;
use CodeIgniter\HTTP\ResponseInterface;

class Penghuni extends BaseController
{
    protected $penghuniModel;
    public function __construct()
    {
        $this->penghuniModel = new PenghuniModel();
    }

    public function index()
    {
        $data['penghuni'] = $this->penghuniModel->findAll();
        return view('admin/penghuni/index', $data);
    }

    public function show($id)
    {
        $data['penghuni'] = $this->penghuniModel->find($id);
        return view('admin/penghuni/show', $data);
    }

    public function create()
    {
        return view('admin/penghuni/create');
    }

    public function store()
    {
        $this->penghuniModel->save($this->request->getPost());
        return redirect()->to('/admin/penghuni');
    }

    public function edit($id)
    {
        $data['penghuni'] = $this->penghuniModel->find($id);
        return view('admin/penghuni/edit', $data);
    }

    public function update($id)
    {
        $this->penghuniModel->update($id, $this->request->getPost());
        return redirect()->to('/admin/penghuni');
    }

    public function delete($id)
    {
        $this->penghuniModel->delete($id);
        return redirect()->to('/admin/penghuni');
    }
} 