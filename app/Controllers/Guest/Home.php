<?php

namespace App\Controllers\Guest;

use App\Controllers\BaseController;

class Home extends BaseController
{
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        if (logged_in()) {
            if (in_groups('admin')) {
                return redirect()->to("/dashboard");
            } else {
                return redirect()->to('/beranda');
            }
        } else {
            return redirect()->to('/beranda');
        }
    }

    public function beranda()
    {
        $getAllBanner = $this->db->table('banner')->get();
        $getBestSeller = $this->db->table('barang')
            ->select('barang.*, gambar.nama as gambar, SUM(detail_pesanan.jumlah) as pembelian')
            ->join('gambar', 'barang.id = gambar.barang_id')
            ->join('detail_pesanan', 'barang.id = detail_pesanan.barang_id')
            ->groupBy('barang.id')
            ->orderBy('pembelian ASC')
            ->limit(8)
            ->get();

        $getNewest = $this->db->table('barang')
            ->select('barang.*, gambar.nama as gambar')
            ->join('gambar', 'barang.id = gambar.barang_id')
            ->groupBy('barang.id')
            ->orderBy('barang.created_at ASC')
            ->limit(10)
            ->get();

        $data = [
            'title' => 'Beranda',
            'banner' => $getAllBanner->getResultArray(),
            'barang' => $getBestSeller->getResultArray(),
            'terbaru' => $getNewest->getResultArray()
        ];

        return view('guest/home/index', $data);
    }
}
