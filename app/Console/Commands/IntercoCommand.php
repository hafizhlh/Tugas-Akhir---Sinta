<?php

namespace App\Console\Commands;

use App\Imports\IntercoImport;
use App\Models\IntercoUpl;
use Illuminate\Console\Command;

class IntercoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'interco:insertdb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inserting Interco List from Excel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        $query = IntercoUpl::where('status', 0);
//        if ($query->count()) {
//            $file = $query->first();
//            $this->output->title("Importing Excel");
//            (new IntercoImport($file->periode_id, $file->id))->withOutput($this->output)->import(storage_path('app/' . $file->filepath));
//            $this->output->success('Import Success');
//        } else {
//            $this->output->success("No Excel were found");
//        }
    }
}
