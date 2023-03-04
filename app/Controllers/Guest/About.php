<?php

namespace App\Controllers\Guest;

use App\Controllers\BaseController;

class About extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Tentang Kami'
        ];

        return view('guest/about/index', $data);
    }
}
