<?php

// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth'); // Menerapkan middleware di seluruh metode controller
    // }

    public function index()
    {
        return view('dashboard');
    }

    public function keputusan()
    {

        return view('keputusan');
    }

    public function perencanaan()
    {
        return view('perencanaan');
    }

    public function pengukuran()
    {
        return view('pengukuran');  // Pastikan file pengukuran.blade.php ada di folder resources/views
    }
    public function pelaporan()
    {
        return view('pelaporan');  // Pastikan file pengukuran.blade.php ada di folder resources/views
    }
    public function evaluasi()
    {
        return view('evaluasi');  // Pastikan file pengukuran.blade.php ada di folder resources/views
    }
}

