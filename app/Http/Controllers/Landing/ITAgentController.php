<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ITAgentController extends Controller
{
    public function index()
    {
        $active = 'ITAgent';
        return view('itagent', compact('active'));
    }
}
