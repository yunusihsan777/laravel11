<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengukuranController extends Controller
{
    public function index()
    {
        return view('kelola.pengukuran');
    }
}
