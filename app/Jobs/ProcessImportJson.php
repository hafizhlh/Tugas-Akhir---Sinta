<?php

namespace App\Jobs;

use App\Models\Account;
use App\Models\Company;
use App\Models\Interco;
use App\Models\IntercoUpl;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessImportJson implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $upl;

    public $timeout = 0;

    public $tries = 100;

    public function __construct(IntercoUpl $upl)
    {
        $this->upl = $upl;
    }

    public function handle()
    {
        try {
            $dataFile = $this->upl;

            $findFile = IntercoUpl::where('id', '=', $dataFile->id);

            if ($findFile->count()) {
                $file = $findFile->first();
                $data = json_decode(file_get_contents(storage_path('app/public/' . $file->filename)), true);
                $inserted = 0;
                foreach ($data as $row) {
                    $interco = str_replace('R', '', $row['interco_key']);

                    Company::firstOrCreate(
                        ['company_code' => $row['entity_key']],
                        ['company_name' => $row['entity']]
                    );

                    Company::firstOrCreate(
                        ['company_code' => $interco],
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
                        ->where('interco', '=', $interco)
                        ->where('account_key', '=', $row["account_key"])
                        ->where('periode_id', '=', $file->periode_id)->count();

                    if (!$findInterco) {
                        Interco::create([
                            'periode_id'    => $file->periode_id,
                            'company'       => $row["entity_key"],
                            'interco'       => $interco,
                            'time_key'      => $row["time_key"],
                            'account_key'   => $row["account_key"],
                            'account'       => $row["account"],
                            'saldo_awal'    => $row["nilai"],
                            'saldo_akhir'   => 0,
                            'verifikasi'    => 0
                        ]);
                        $inserted++;
                    }
                }
                $file->status = 1;
                $file->inserted_data = $inserted;
                $file->save();
            } else {
                $res = [
                    "message" => "No excel were found"
                ];
            }
        } catch(Exception $e){
            Log::error($e);
            throw $e; // rethrow to make job fail
        }
    }
}
