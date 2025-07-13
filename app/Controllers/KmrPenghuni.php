<?php
namespace App\Controllers;

use App\Models\KmrPenghuniModel;
use CodeIgniter\HTTP\ResponseInterface;

class KmrPenghuni extends BaseController
{
    protected $kmrPenghuniModel;
    public function __construct()
    {
        $this->kmrPenghuniModel = new KmrPenghuniModel();
    }

    public function index()
    {
        $data['kmr_penghuni'] = $this->kmrPenghuniModel->findAll();
        return view('admin/kmr_penghuni/index', $data);
    }

    public function show($id)
    {
        $data['kmr_penghuni'] = $this->kmrPenghuniModel->find($id);
        return view('admin/kmr_penghuni/show', $data);
    }

    public function create()
    {
        return view('admin/kmr_penghuni/create');
    }

    public function store()
    {
        $this->kmrPenghuniModel->save($this->request->getPost());
        return redirect()->to('/admin/kmr-penghuni');
    }

    public function edit($id)
    {
        $data['kmr_penghuni'] = $this->kmrPenghuniModel->find($id);
        return view('admin/kmr_penghuni/edit', $data);
    }

    public function update($id)
    {
        $this->kmrPenghuniModel->update($id, $this->request->getPost());
        return redirect()->to('/admin/kmr-penghuni');
    }

    public function delete($id)
    {
        $this->kmrPenghuniModel->delete($id);
        return redirect()->to('/admin/kmr-penghuni');
    }
} 