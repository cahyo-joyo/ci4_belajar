<?php

namespace App\Controllers;

use Config\View;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | Web Programming'
        ];
        return view('Pages/Home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Me'
        ];
        return view('Pages/About', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact',
            'alamat' => [
                [
                    'tipe' => 'rumah',
                    'alamat' => 'Jl. Kalianak',
                    'kota' => 'Surabaya'
                ],
                [
                    'tipe' => 'kantor',
                    'alamat' => 'Jl. ambak Asri',
                    'kota' => 'surabaya'
                ]
            ]
        ];
        return view('Pages/Contact', $data);
    }

    //--------------------------------------------------------------------

}
