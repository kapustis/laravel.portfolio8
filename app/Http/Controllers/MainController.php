<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Наша компания',
            'description' => 'Наша компания - самая лучшая в своём роде. Ахаха'
        ];

        return view('index', $data);
    }
}
