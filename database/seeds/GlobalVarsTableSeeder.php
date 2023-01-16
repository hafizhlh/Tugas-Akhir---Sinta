<?php

use App\Models\GlobalVar;
use Illuminate\Database\Seeder;

class GlobalVarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $datas = [
            ['group'=> 'ROUTE', 'name' => 'METHOD', 'desc' => 'GET method of the routes', 'value' => 'GET'],
            ['group'=> 'ROUTE', 'name' => 'METHOD', 'desc' => 'POST method of the routes', 'value' => 'POST'],
            ['group'=> 'ROUTE', 'name' => 'METHOD', 'desc' => 'PUT method of the routes', 'value' => 'PUT'],
            ['group'=> 'ROUTE', 'name' => 'METHOD', 'desc' => 'DELETE method of the routes', 'value' => 'DELETE'],
        ];
        
        GlobalVar::insert($datas);
        $this->command->info("Global Variable Seeder Success !");
    }
}
