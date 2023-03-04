<?php

namespace App\Controllers\Guest;

use App\Controllers\BaseController;

class Katalog extends BaseController
{
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $getAllBarang = $this->db->table('barang')
            ->select('barang.*, gambar.nama as gambar')
            ->join('gambar', 'barang.id = gambar.barang_id', 'left')
            ->groupBy('barang.id')
            ->get();

        $getKategori = $this->db->table('kategori')->get();

        $data = [
            'title' => 'Katalog',
            'barang' => $getAllBarang->getResultArray(),
            'kategori' => $getKategori->getResultArray()
        ];

        return view('guest/katalog/index', $data);
    }

    public function filter($kategori)
    {
        $getAllBarang = $this->db->table('barang')
            ->select('barang.*, gambar.nama as gambar')
            ->join('gambar', 'barang.id = gambar.barang_id', 'left')
            ->join('kategori', 'barang.kategori_id = kategori.id')
            ->where('kategori.nama', $kategori)
            ->groupBy('barang.id')
            ->get();

        $getKategori = $this->db->table('kategori')->get();

        $data = [
            'title' => 'Katalog',
            'barang' => $getAllBarang->getResultArray(),
            'kategori' => $getKategori->getResultArray()
        ];

        return view('guest/katalog/index', $data);
    }

    public function detail($slug)
    {
        $getDetailItem = $this->db->table('barang')
            ->where('barang.slug', $slug)
            ->get();

        $getImage = $this->db->table('gambar')
            ->select('gambar.nama, gambar.id')
            ->join('barang', 'gambar.barang_id = barang.id', 'left')
            ->where('slug', $slug)
            ->get();

        $getOtherItem = $this->db->table('barang')->select('barang.*, gambar.nama as gambar')
            ->join('gambar', 'barang.id = gambar.barang_id', 'left')
            ->groupBy('barang.id')
            ->limit(5)
            ->get();

        $data = [
            'title' => 'Detail Barang',
            'barang' => $getDetailItem->getRowArray(),
            'gambar' => $getImage->getResultArray(),
            'barang_lainya' => $getOtherItem->getResultArray()
        ];

        return view('guest/katalog/detail', $data);
    }
}
