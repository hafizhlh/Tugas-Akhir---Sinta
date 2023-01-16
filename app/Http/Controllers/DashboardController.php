<?php

namespace App\Http\Controllers;

use App\Models\Ba;
use App\Models\Company;
use App\Models\Interco;
use App\Models\IntercoPeriode;
use DB;
use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {

        $data['menus'] = $this->getDashboardMenu();
        return view('dashboard', $data);

    }

}
