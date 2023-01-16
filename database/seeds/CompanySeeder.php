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
            ['company_code' => 'A000', 'company_name' => 'PT Pupuk Indonesia (Persero)'],
            ['company_code' => 'B000', 'company_name' => 'PT Petrokimia Gresik'],
            ['company_code' => 'BA00', 'company_name' => 'PT Petrosida Gresik'],
            ['company_code' => 'BB00', 'company_name' => 'PT Petrokimia Kayaku'],
            ['company_code' => 'C000', 'company_name' => 'PT Pupuk Kujang'],
            ['company_code' => 'CA00', 'company_name' => 'PT Sintas Kurama Perdana'],
            ['company_code' => 'CB00', 'company_name' => 'PT Kawasan Industri Kujang Cikampek'],
            ['company_code' => 'D000', 'company_name' => 'PT Pupuk Kalimantan Timur'],
            ['company_code' => 'DA00', 'company_name' => 'PT Kaltim Industrial Estate'],
            ['company_code' => 'E000', 'company_name' => 'PT Pupuk Iskandar Muda'],
            ['company_code' => 'F000', 'company_name' => 'PT Pupuk Sriwidjaja Palembang'],
            ['company_code' => 'FA00', 'company_name' => 'PT Pusri Agro Lestari'],
            ['company_code' => 'G000', 'company_name' => 'PT Rekayasa Industri'],
            ['company_code' => 'GA00', 'company_name' => 'PT Yasa Industri Nusantara'],
            ['company_code' => 'GB00', 'company_name' => 'PT Tracon Industri'],
            ['company_code' => 'GC00', 'company_name' => 'PT Rekayasa Engineering'],
            ['company_code' => 'GE00', 'company_name' => 'REKIND Malaysia, Sdn, Bhd'],
            ['company_code' => 'GF00', 'company_name' => 'PT REKIND Daya Mamuju'],
            ['company_code' => 'GK00', 'company_name' => 'PT Puspetindo'],
            ['company_code' => 'H000', 'company_name' => 'PT Mega Eltra'],
            ['company_code' => 'HA00', 'company_name' => 'PT Sigma Utama'],
            ['company_code' => 'I000', 'company_name' => 'PT Pupuk Indonesia Logistik'],
            ['company_code' => 'J000', 'company_name' => 'PT Pupuk Indonesia Energi'],
            ['company_code' => 'JA00', 'company_name' => 'PT Kaltim Daya Mandiri'],
            ['company_code' => 'JAA0', 'company_name' => 'PT KDM Agro Energi'],
            ['company_code' => 'JAB0', 'company_name' => 'PT Banyumas Energi Lestari'],
            ['company_code' => 'K000', 'company_name' => 'PT Pupuk Indonesia Pangan'],
        ];

        Company::insert($company);
        $this->command->info('Company Seeders SuccessFull');
    }
}
