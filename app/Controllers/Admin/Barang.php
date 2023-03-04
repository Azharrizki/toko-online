<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Barang extends BaseController
{
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $getAllBarang = $this->db->table('barang')
            ->select('barang.*, kategori.nama as nama_kategori, gambar.nama as nama_gambar')
            ->join('kategori', 'barang.kategori_id = kategori.id')
            ->join('gambar', 'barang.id = gambar.barang_id')
            ->groupBy('barang.id')
            ->orderBy('created_at ASC')
            ->get();

        $data = [
            'title' => 'Data Barang',
            'barang' => $getAllBarang->getResultArray()
        ];

        return view('admin/barang/index', $data);
    }

    public function tambah()
    {
        $getKategori = $this->db->table('kategori')->get();

        $data = [
            'title' => 'Tambah Barang',
            'kategori' => $getKategori->getResultArray()
        ];

        return view('admin/barang/tambah', $data);
    }

    public function add()
    {
        if (!$this->validate([
            'id' => [
                'rules' => 'is_unique[barang.id]',
                'errors' => [
                    'is_unique' => 'Kode barang sudah digunakan.',
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom nama barang harus diisi.'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom deskripsi barang harus diisi.'
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom harga barang harus diisi.'
                ]
            ],
            'stok' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom stok barang harus diisi.'
                ]
            ],
            'kategori_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom kategori barang harus diisi.'
                ]
            ],
            'berat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom berat barang harus diisi.'
                ]
            ],
        ])) {
            session()->setFlashdata('gagal', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $id = 'BRG-' . random_string('numeric', 5);
        $slug = url_title($this->request->getVar('nama'), '-', true);
        $data = [
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'slug' => $slug,
            'deskripsi' => $this->request->getVar('deskripsi'),
            'kategori_id' => $this->request->getVar('kategori_id'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
            'berat' => $this->request->getVar('berat'),
            'created_by' => user_id(),
            'updated_by' => user_id()
        ];
        $this->db->table('barang')->insert($data);

        $images = $this->request->getFileMultiple('images');
        if ($images) {
            foreach ($images as $image) {
                $filename = $image->getRandomName();
                $image->move('img', $filename);
                $data_gambar[] = [
                    'barang_id' => $id,
                    'nama' =>  $filename
                ];
            }
            $this->db->table('gambar')->insertBatch($data_gambar);
        }

        session()->setFlashdata('berhasil', 'Data barang berhasil ditambahkan');
        return redirect()->to('data-barang');
    }

    public function detail($id)
    {
        $getBarang = $this->db->table('barang')->where('id', $id)->get();
        $getGambar = $this->db->table('gambar')->where('barang_id', $id)->get();
        $getKategori = $this->db->table('kategori')->get();
        $data = [
            'title' => 'Detail Barang',
            'barang' => $getBarang->getRowArray(),
            'gambar' => $getGambar->getResultArray(),
            'kategori' => $getKategori->getResultArray()
        ];

        return view('admin/barang/detail', $data);
    }

    public function edit()
    {
        if (!$this->validate([
            'id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom nama barang harus diisi.'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom nama barang harus diisi.'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom deskripsi barang harus diisi.'
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom harga barang harus diisi.'
                ]
            ],
            'stok' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom stok barang harus diisi.'
                ]
            ],
            'berat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom berat barang harus diisi.'
                ]
            ],
        ])) {
            session()->setFlashdata('gagal', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $id = $this->request->getVar('id');
        $data = [
            'nama' => $this->request->getVar('nama'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'harga' => $this->request->getVar('harga'),
            'kategori_id' => $this->request->getVar('kategori_id'),
            'stok' => $this->request->getVar('stok'),
            'berat' => $this->request->getVar('berat'),
            'updated_by' => user_id()
        ];
        $this->db->table('barang')->where('id', $id)->update($data);

        $images = $this->request->getFileMultiple('images');
        if ($images) {
            $this->db->table('gambar')->where('barang_id', $id)->delete();
            foreach ($images as $image) {
                $filename = $image->getRandomName();
                $image->move('img', $filename);
                $data_gambar[] = [
                    'barang_id' => $id,
                    'nama' =>  $filename
                ];
            }
            $this->db->table('gambar')->insertBatch($data_gambar);
        }

        session()->setFlashdata('berhasil', 'Data barang berhasil ditambahkan');
        return redirect()->to('data-barang');
    }

    public function delete()
    {
        $data = [
            'id' => $this->request->getVar('id')
        ];

        $this->db->table('barang')->delete($data);
        $this->db->table('gambar')->where('barang_id', $data)->delete();

        session()->setFlashdata('berhasil', 'Selamat data berhasil dihapus');
        return redirect()->back();
    }
}
