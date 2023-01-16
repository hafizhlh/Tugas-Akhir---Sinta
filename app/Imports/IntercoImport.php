<?php

namespace App\Imports;

use App\Models\Account;
use App\Models\Company;
use App\Models\Interco;
use App\Models\IntercoUpl;
//use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use phpDocumentor\Reflection\Types\Null_;

//use Maatwebsite\Excel\Concerns\WithProgressBar;

class IntercoImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

//    use Importable;

    protected $periode_id;
    protected $doc_id;

    public function __construct($periode_id, $doc_id)
    {
        $this->periode_id = $periode_id;
        $this->doc_id = $doc_id;
    }

    public function model(array $row)
    {
        // TODO: Implement model() method.

        ini_set('max_execution_time', 180); //3 minutes

        Company::firstOrCreate(
            ['company_code' => $row['entity_key']],
            ['company_name' => $row['entity']]
        );

        Company::firstOrCreate(
            ['company_code' => $row['interco_key']],
            ['company_name' => $row['interco']]
        );

        Account::firstOrCreate(
            ['account_code' => $row['account_key']],
            [
                'account_name' => $row['account'],
                'group_code' => 'TS00'
            ]
        );

        $findInterco = Interco::all()
            ->where('company', '=', $row["entity_key"])
            ->where('interco', '=', $row["interco_key"])
            ->where('account_key', '=', $row["account_key"])
            ->where('saldo_awal', '=', $row["nilai"])->count();

        if ($findInterco) {
            $upd = IntercoUpl::find($this->doc_id);
            $upd->status = 1;
            $upd->save();
            return null;
        }

        return new Interco([
            'periode_id'    => $this->periode_id,
            'company'       => $row["entity_key"],
            'interco'       => $row["interco_key"],
            'time_key'      => $row["time_key"],
            'account_key'   => $row["account_key"],
            'account'       => $row["account"],
            'saldo_awal'    => $row["nilai"],
            'saldo_akhir'   => 0,
            'verifikasi'    => 0
        ]);
    }
}
