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

}

