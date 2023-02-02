<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TentangTIController extends Controller
{
    public function index()
    {
        $active = 'tentangTI';
        return view('tentangTI', compact('active'));
    }
}
