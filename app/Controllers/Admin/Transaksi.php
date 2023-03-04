<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Transaksi extends BaseController
{
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $getTransaksi = $this->db->table('pesanan')->select('pesanan.*, users.username as nama_pembeli')->join('users', 'pesanan.user_id = users.id')->get()->getResultArray();

        $data = [
            'title' => 'Data Transaksi',
            'transaksi' => $getTransaksi
        ];

        return view('admin/transaksi/index', $data);
    }

    public function detail($id)
    {
        $getPemesan = $this->db->table('pesanan')->select('pesanan.*, users.username as nama_pembeli')->join('users', 'pesanan.user_id = users.id')->where('pesanan.id', $id)->get()->getRowArray();

        $getBarang = $this->db->table('detail_pesanan')->select('detail_pesanan.jumlah as jumlah, barang.nama as nama_barang')
            ->join('barang', 'detail_pesanan.barang_id = barang.id')
            ->where('detail_pesanan.pesanan_id', $id)
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Detail Pesanan',
            'detail_pesanan' => $getBarang,
            'pemesan' => $getPemesan
        ];

        return view('admin/transaksi/detail', $data);
    }
}
