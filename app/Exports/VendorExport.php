<?php

namespace App\Exports;

// use App\Models\Interco;
use App\Models\VendorSAP;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VendorExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $company, $interco, $periode, $account;

    public function __construct($company, $interco, $periode, $account)
    {
        $this->company  = $company;
        $this->interco  = $interco;
        $this->periode  = $periode;
        $this->account  = $account;
    }

    public function view() : View
    {
        // $getData = VendorSAP::has('intercoPeriode')
        //     ->with(['intercoPeriode', 'entityComps', 'intercoComps', 'accounts']);
        $getData = VendorSAP::selectRaw('periode_id,company,interco,account_key,time_key,sum(saldo_awal) as saldo_awal')->has('intercoPeriode')->with(['intercoPeriode', 'entityComps', 'intercoComps', 'accounts'])->groupBy('periode_id','company','interco','account_key','time_key');
        if ($this->periode != "0") {
            $getData = $getData->where('periode_id', 'like', '%' . $this->periode . '%');
        }
        if ($this->company != "0") {
            $getData = $getData->where('company', 'like', '%' . $this->company . '%');
        }
        if ($this->interco != "0") {
            $getData = $getData->where('interco', 'like', '%' . $this->interco . '%');
        }
        if ($this->account != "0") {
            $getData = $getData->where('account_key', 'like', '%' . $this->account . '%');
        }

        $data = $getData->get();
        return view('intercoDownload', compact('data'));
    }
}
