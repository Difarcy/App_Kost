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
        $data['tagihan'] = $this->tagihanModel->findAll();
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