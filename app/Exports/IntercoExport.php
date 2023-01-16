<?php

namespace App\Exports;

use App\Models\Interco;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class IntercoExport extends DefaultValueBinder implements WithCustomValueBinder,FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $company, $interco, $periode, $account, $progress, $status;

    public function __construct($company, $interco, $periode, $account, $progress)
    {
        $this->company  = $company;
        $this->interco  = $interco;
        $this->periode  = $periode;
        $this->account  = $account;
        $this->progress = $progress;
    }

    public function view() : View
    {
        $getData = Interco::has('intercoPeriode')
            ->with(['intercoPeriode', 'entityComps', 'intercoComps', 'accounts']);
        if ($this->periode != "0") {
            $getData = $getData->where('periode_id', '=', $this->periode);
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
        if ($this->progress != "0") {
            $getData = $getData->where('status', 'like', '%' . $this->progress . '%');
        }
        $data = $getData->get();
        foreach($data as $k => $row){
            //Deliminate not is_syncrhonize = 1
            if($row->accounts->is_synchronize!='1'){
                unset($data[$k]);
                continue;
            }
            //Deliminate Induk with Anper
            if(($row->entityComps->parent_company_code==$row->interco && $row->entityComps->parent_company_code!='A000') || ($row->intercoComps->parent_company_code==$row->company && $row->intercoComps->parent_company_code!='A000')){
                unset($data[$k]);
                continue;
            }
        }
        return view('intercoDownload', compact('data'));
    }

    public function bindValue(Cell $cell, $value)
    {
        if ($cell->getColumn() == 'A') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }
        if ($cell->getColumn() == 'D') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }

}
