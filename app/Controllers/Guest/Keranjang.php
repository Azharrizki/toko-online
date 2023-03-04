<?php

namespace App\Controllers\Guest;

use App\Controllers\BaseController;

class Keranjang extends BaseController
{
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $getAllItem = $this->db->table('keranjang')
            ->select('keranjang.id as id, barang.nama as nama_barang, barang.slug as slug, barang.harga as harga, keranjang.jumlah as qty, gambar.nama as nama_gambar')
            ->join('barang', 'keranjang.barang_id = barang.id')
            ->join('gambar', 'keranjang.barang_id = gambar.barang_id', 'left')
            ->where('keranjang.user_id', user_id())
            ->groupBy('barang.id')
            ->get();

        $data = [
            'title' => 'Keranjang',
            'barang' => $getAllItem->getResultArray()
        ];

        return view('guest/keranjang/index', $data);
    }

    public function addToCart()
    {
        if (logged_in()) {
            if (!$this->validate([
                'barang_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pilih salah satu barang untuk dimasukan kedalam keranjang.'
                    ]
                ],
                'jumlah' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Masukan jumlah barang.'
                    ]
                ]
            ])) {
                session()->setFlashdata('gagal', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }

            $data = [
                'user_id' =>  user_id(),
                'barang_id' => $this->request->getVar('barang_id'),
                'jumlah' => $this->request->getVar('jumlah')
            ];

            $this->db->table('keranjang')->insert($data);

            session()->setFlashdata('berhasil', 'Barang berhasil ditambahkan kedalam keranjang');
            return redirect()->to('keranjang');
        } else {
            return redirect()->to('login');
        }
    }

    public function updateCart()
    {
        $id = $this->request->getVar('id');
        $data = [
            'jumlah' => $this->request->getVar('jumlah')
        ];

        $this->db->table('keranjang')
            ->where('id', $id)
            ->update($data);
    }

    public function deleteCart($id)
    {
        $this->db->table('keranjang')->where('id', $id)->delete();

        return redirect()->back();
    }

    public function totalHarga()
    {
        $total = 0;
        $barang = $this->db->table('keranjang')
            ->select('keranjang.id as id, barang.nama as nama_barang, barang.slug as slug, barang.harga as harga, keranjang.jumlah as qty, gambar.nama as nama_gambar')
            ->join('barang', 'keranjang.barang_id = barang.id')
            ->join('gambar', 'keranjang.barang_id = gambar.barang_id', 'left')
            ->where('keranjang.user_id', user_id())
            ->groupBy('barang.id')
            ->get()
            ->getResultArray();

        foreach ($barang as $key) {
            $total += $key['harga'] * $key['qty'];
        }
        return  '<span>' . number_to_currency($total, 'IDR') . '</span>';
    }
}
