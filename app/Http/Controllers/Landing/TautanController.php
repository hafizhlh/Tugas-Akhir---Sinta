<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TautanController extends Controller
{
    public function index()
    {
        $active = 'Tautan';
        return view('tautan', compact('active'));
    }
}
