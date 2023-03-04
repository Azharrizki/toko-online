<?php

namespace App\Controllers\Guest;

use App\Controllers\BaseController;

class Checkout extends BaseController
{
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    private $url = "https://api.rajaongkir.com/starter/";
    private $apiKey = "45fcfd2406d2ec247e167171e0eb42e9";

    private function rajaongkir($method, $id_province = null)
    {
        $endPoint = $this->url . $method;

        if ($id_province != null) {
            $endPoint = $endPoint . "?province=" . $id_province;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: " . $this->apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl); {
            return $response;
        }
    }

    private function rajaongkircost($origin, $destination, $weight, $courier)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: " . $this->apiKey,
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return $response;
    }

    public function getCity()
    {

        if ($this->request->isAJAX()) {
            $id_province = $this->request->getGET('id_province');
            $data = $this->rajaongkir('city', $id_province);
            return $this->response->setJSON($data);
        }
    }

    public function getCost()
    {
        if ($this->request->isAJAX()) {
            $origin = $this->request->getGet('origin');
            $destination = $this->request->getGet('destination');
            $weight = $this->request->getGet('weight');
            $courier = $this->request->getGet('courier');
            $data = $this->rajaongkircost($origin, $destination, $weight, $courier);
            return $this->response->setJSON($data);
        }
    }

    public function index()
    {
        $getAllItem = $this->db->table('keranjang')
            ->select('keranjang.id as id, barang.id as barang_id, barang.nama as nama_barang, barang.harga as harga, keranjang.jumlah as qty, barang.berat as berat')
            ->join('barang', 'keranjang.barang_id = barang.id')
            ->where('keranjang.user_id', user_id())
            ->get();

        $getPembayaran = $this->db->table('pembayaran')->get();

        $data = [
            'title' => 'Checkout Barang',
            'provinsi' => json_decode($this->rajaongkir('province'))->rajaongkir->results,
            'barang' => $getAllItem->getResultArray(),
            'pembayaran' => $getPembayaran->getRowArray()
        ];
        return view('guest/checkout/index', $data);
    }

    public function beli()
    {
        if (!$this->validate([
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat anda harus diisi.'
                ]
            ],
            'total' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat anda harus diisi.'
                ]
            ],
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat anda harus diisi.'
                ]
            ],
        ])) {
            session()->setFlashdata('gagal', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $barang_id = $this->request->getVar('barang_id');
        $jumlah = $this->request->getVar('jumlah');

        $id = 'INV-' . random_string('numeric', 5);
        $data = [
            'id' => $id,
            'user_id' => user_id(),
            'total' => $this->request->getVar('total'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telp' => $this->request->getVar('no_telp')
        ];

        $this->db->transStart();
        $this->db->table('pesanan')->insert($data);

        $countCart = count($barang_id);

        for ($i = 0; $i < $countCart; $i++) {
            $data_pesanan = [
                'pesanan_id' => $id,
                'barang_id' => $barang_id[$i],
                'jumlah' => $jumlah[$i]
            ];

            $this->db->table('detail_pesanan')->insert($data_pesanan);

            $barang = $this->db->table('barang')->where('id', $barang_id[$i])->get()->getRow();
            $stok_baru = $barang->stok - $jumlah[$i];
            $this->db->table('barang')->update([
                'stok' => $stok_baru
            ], ['id' => $barang_id[$i]]);
        }
        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            session()->setFlashdata('gagal', 'Gagal melakukan checkout keranjang.');
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('berhasil', 'Keranjang berhasil di checkout, Silahkan konfirmasi pembayaran melalui whatsapp.');
        return redirect()->to('katalog');
    }
}
