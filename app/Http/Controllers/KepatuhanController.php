<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KepatuhanController extends Controller
{
    public function index()
    {
        return view('kepatuhan');
    }
}
