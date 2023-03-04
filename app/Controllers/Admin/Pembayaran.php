<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Pembayaran extends BaseController
{
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $getData = $this->db->table('pembayaran')->limit(1)->get()->getRowArray();

        $data = [
            'title' => 'Data Pembayaran',
            'pembayaran' => $getData
        ];

        return view('admin/pembayaran/index', $data);
    }

    public function detail($id)
    {
        $getDetail = $this->db->table('pembayaran')->where('id', $id)->get()->getRowArray();

        $data = [
            'title' => 'Data Pembayaran',
            'pembayaran' => $getDetail
        ];

        return view('admin/pembayaran/detail', $data);
    }

    public function edit()
    {
        $id = $this->request->getVar('id');

        $data = [
            'nama' => $this->request->getVar('nama'),
            'rekening' => $this->request->getVar('rekening'),
            'no_rekening' => $this->request->getVar('no_rekening'),
        ];

        $this->db->table('pembayaran')->where('id', $id)->update($data);

        session()->setFlashdata('berhasil', 'Data barang berhasil ditambahkan');
        return redirect()->to('data-pembayaran');
    }
}
