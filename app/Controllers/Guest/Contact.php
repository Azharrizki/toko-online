<?php

namespace App\Controllers\Guest;

use App\Controllers\BaseController;

class Contact extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Contact Us'
        ];

        return view('guest/contact/index', $data);
    }
}
