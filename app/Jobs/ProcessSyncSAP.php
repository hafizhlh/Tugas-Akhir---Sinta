<?php

namespace App\Jobs;

use App\Models\IntercoSync;
use App\Services\IntercoSAPService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class ProcessSyncSAP implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $sync;

    public $timeout = 0;

    public $tries = 1;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(IntercoSync $sync)
    {
        $this->sync = $sync;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $dataFile = $this->sync;
            $find = IntercoSync::where('id', '=', $dataFile->id);

            if ($find->count()) {
                $file = $find->first();

                if($file->queue =="Fbl3nSync")
                $response = (new IntercoSAPService)->getInterco($file);
                else if($file->queue =="Fbl1nSync"){
                    $response = (new IntercoSAPService)->getVendor($file);
                }
                else if($file->queue =="Fbl5nSync"){
                    $response = (new IntercoSAPService)->getCustomer($file);
                }
                else if($file->queue =="BWConsol"){
                    $response = (new IntercoSAPService)->getConsolidationBW($file);
                }
                
              if($response['status']){
                $file->status = 1; //Success
                $file->total_data = $response['total_data'];
                $file->inserted_data = $response['inserted_data'];
                $file->updated_data = $response['updated_data'];
                $file->keterangan = isset($response['messages'])?$response['messages']:"";
                $file->updated_at = date("Y-m-d H:i:s");
                $file->save();
                //Chaining To Fbl1n,Fbl3n,Fbl5n
                if($file->queue =="BWConsol"){
                    $listCompany = Company::select('company_code')->where('delete_mark','=','0')->where('is_sap','=','1')->get();
                    foreach($listCompany as  $k=>$v){
                        $fbl3n = IntercoSync::updateOrCreate([
                            'queue'             => 'Fbl3nSync',
                            'periode_id'        => $file->periode_id,
                            'start_date'        => $file->start_date,
                            'end_date'          => $file->end_date,
                            'company'           => $v['company_code'],
                        ],[
                                    'total_data'        => 0,
                                    'inserted_data'     => 0,
                                    'updated_data'      => 0,
                                    'status'            => 0,
                                    'attemps'           => DB::raw('attemps + 1'),
                                    'updated_at'        => date("Y-m-d H:i:s"),
                                    'created_at'        => date("Y-m-d H:i:s")
                        ]);

                        $fbl1n = IntercoSync::updateOrCreate([
                            'queue'             => 'Fbl1nSync',
                            'periode_id'        => $file->periode_id,
                            'start_date'        => $file->start_date,
                            'end_date'          => $file->end_date,
                            'company'           => $v['company_code'],
                        ],[
                                    'total_data'        => 0,
                                    'inserted_data'     => 0,
                                    'updated_data'      => 0,
                                    'status'            => 0,
                                    'attemps'           => DB::raw('attemps + 1'),
                                    'updated_at'        => date("Y-m-d H:i:s"),
                                    'created_at'        => date("Y-m-d H:i:s")
                        ]);

                        $fbl5n = IntercoSync::updateOrCreate([
                            'queue'             => 'Fbl5nSync',
                            'periode_id'        => $file->periode_id,
                            'start_date'        => $file->start_date,
                            'end_date'          => $file->end_date,
                            'company'           => $v['company_code'],
                        ],[
                                    'total_data'        => 0,
                                    'inserted_data'     => 0,
                                    'updated_data'      => 0,
                                    'status'            => 0,
                                    'attemps'           => DB::raw('attemps + 1'),
                                    'updated_at'        => date("Y-m-d H:i:s"),
                                    'created_at'        => date("Y-m-d H:i:s")
                        ]);
                        
                        // $fbl1n = $fbl3n->replicate()->fill([
                        //      'queue' => 'Fbl1nSync'
                        // ]);
                        // $fbl1n->save();
                        // $fbl5n = $fbl3n->replicate()->fill([
                        //      'queue' => 'Fbl5nSync'
                        // ]);
                        // $fbl5n->save();
                        ProcessSyncSAP::dispatch($fbl3n)->onQueue('Fbl3nSync')->onConnection('database');
                        ProcessSyncSAP::dispatch($fbl1n)->onQueue('Fbl1nSync')->onConnection('database');
                        ProcessSyncSAP::dispatch($fbl5n)->onQueue('Fbl5nSync')->onConnection('database');
                    }
                }
              }else{
                  $file->status = 2; //Gagal
                  $file->keterangan = $response['messages'];
                  $file->updated_at = date("Y-m-d H:i:s");
                  $file->save();
              }
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
