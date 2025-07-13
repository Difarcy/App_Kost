<?php
namespace App\Controllers;

use App\Models\BrngBawaanModel;
use CodeIgniter\HTTP\ResponseInterface;

class BrngBawaan extends BaseController
{
    protected $brngBawaanModel;
    public function __construct()
    {
        $this->brngBawaanModel = new BrngBawaanModel();
    }

    public function index()
    {
        $data['brng_bawaan'] = $this->brngBawaanModel->findAll();
        return view('admin/brng_bawaan/index', $data);
    }

    public function show($id)
    {
        $data['brng_bawaan'] = $this->brngBawaanModel->find($id);
        return view('admin/brng_bawaan/show', $data);
    }

    public function create()
    {
        return view('admin/brng_bawaan/create');
    }

    public function store()
    {
        $this->brngBawaanModel->save($this->request->getPost());
        return redirect()->to('/admin/brng-bawaan');
    }

    public function edit($id)
    {
        $data['brng_bawaan'] = $this->brngBawaanModel->find($id);
        return view('admin/brng_bawaan/edit', $data);
    }

    public function update($id)
    {
        $this->brngBawaanModel->update($id, $this->request->getPost());
        return redirect()->to('/admin/brng-bawaan');
    }

    public function delete($id)
    {
        $this->brngBawaanModel->delete($id);
        return redirect()->to('/admin/brng-bawaan');
    }
} 