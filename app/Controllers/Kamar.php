<?php
namespace App\Controllers;

use App\Models\KamarModel;
use CodeIgniter\HTTP\ResponseInterface;

class Kamar extends BaseController
{
    protected $kamarModel;
    public function __construct()
    {
        $this->kamarModel = new KamarModel();
    }

    public function index()
    {
        $data['kamar'] = $this->kamarModel->findAll();
        return view('admin/kamar/index', $data);
    }

    public function show($id)
    {
        $data['kamar'] = $this->kamarModel->find($id);
        return view('admin/kamar/show', $data);
    }

    public function create()
    {
        return view('admin/kamar/create');
    }

    public function store()
    {
        $this->kamarModel->save($this->request->getPost());
        return redirect()->to('/admin/kamar');
    }

    public function edit($id)
    {
        $data['kamar'] = $this->kamarModel->find($id);
        return view('admin/kamar/edit', $data);
    }

    public function update($id)
    {
        $this->kamarModel->update($id, $this->request->getPost());
        return redirect()->to('/admin/kamar');
    }

    public function delete($id)
    {
        $this->kamarModel->delete($id);
        return redirect()->to('/admin/kamar');
    }
} 