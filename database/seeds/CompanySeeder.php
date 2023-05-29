<?php

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $company = [
            ['company_code' => '', 'company_name' => 'P'],
           
        ];

        Company::insert($company);
        $this->command->info('Company Seeders SuccessFull');
    }
}
