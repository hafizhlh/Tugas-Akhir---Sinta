<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SecurityAwarenessController extends Controller
{
    public function index()
    {
        $active = 'SecurityAwareness';
        return view('security', compact('active'));
    }
}
