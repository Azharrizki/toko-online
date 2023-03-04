<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $countOrders = $this->db->table('pesanan')->get()->getResultArray();
        $countTerjual = $this->db->table('detail_pesanan')->select('SUM(jumlah) as terjual')->get();
        $countBarang = $this->db->table('barang')->get()->getResultArray();

        $data = [
            'title' => 'Dashboard Admin',
            'order' => count($countOrders),
            'terjual' => $countTerjual->getRowArray(),
            'barang' => count($countBarang)
        ];

        return view('admin/dashboard/index', $data);
    }
}
