<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Banner extends BaseController
{
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $getAllBanner = $this->db->table('banner')->get();
        $data = [
            'title' => 'Data Banner',
            'banner' => $getAllBanner->getResultArray()
        ];

        return view('admin/banner/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Data Banner'
        ];

        return view('admin/banner/tambah', $data);
    }

    public function add()
    {
        if (!$this->validate([
            'meta_text' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom meta text banner harus diisi.'
                ]
            ],
            'title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom title 1 barang harus diisi.'
                ]
            ],
        ])) {
            session()->setFlashdata('gagal', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $image = $this->request->getFile('image');

        $fileImage = $image->getRandomName();

        $image->move('img', $fileImage);

        $data = [
            'meta_text' => $this->request->getVar('meta_text'),
            'title' => $this->request->getVar('title'),
            'image' => $fileImage
        ];
        $this->db->table('banner')->insert($data);

        session()->setFlashdata('berhasil', 'Banner baru berhasil ditambahkan');
        return redirect()->to('data-banner');
    }

    public function detail($id)
    {
        $getBanner = $this->db->table('banner')->where('id', $id)->get();
        $data = [
            'title' => 'Detail Banner',
            'banner' => $getBanner->getRowArray(),
        ];

        return view('admin/banner/detail', $data);
    }

    public function edit()
    {
        if (!$this->validate([
            'meta_text' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom meta text banner harus diisi.'
                ]
            ],
            'title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom title barang harus diisi.'
                ]
            ]
        ])) {
            session()->setFlashdata('gagal', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $id = $this->request->getVar('id');
        $image = $this->request->getFile('image');
        $fileImage = $image->getRandomName();
        $image->move('img', $fileImage);

        $data = [
            'title' => $this->request->getVar('title'),
            'meta_text' => $this->request->getVar('meta_text'),
            'image' => $fileImage
        ];

        $this->db->table('banner')->where('id', $id)->update($data);

        session()->setFlashdata('berhasil', 'Data banner berhasil diupdate');
        return redirect()->to('data-banner');
    }

    public function delete()
    {
        $data = [
            'id' => $this->request->getVar('id')
        ];

        $this->db->table('banner')->delete($data);

        session()->setFlashdata('berhasil', 'Selamat data banner berhasil dihapus');
        return redirect()->back();
    }
}
