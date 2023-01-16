<?php

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UpdateCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ['company_code' => 'A000', 'company_name' => 'PT Pupuk Indonesia (Persero)'],
        Company::where(['company_code' => 'B000', 'company_name' => 'PT Petrokimia Gresik'])->update(['parent_company_code' => 'A000']);
        Company::where(['company_code' => 'BA00', 'company_name' => 'PT Petrosida Gresik'])->update(['parent_company_code' => 'B000']);
        Company::where(['company_code' => 'BB00', 'company_name' => 'PT Petrokimia Kayaku'])->update(['parent_company_code' => 'B000']);
        Company::where(['company_code' => 'C000', 'company_name' => 'PT Pupuk Kujang'])->update(['parent_company_code' => 'A000']);
        Company::where(['company_code' => 'CA00', 'company_name' => 'PT Sintas Kurama Perdana'])->update(['parent_company_code' => 'C000']);
        Company::where(['company_code' => 'CB00', 'company_name' => 'PT Kawasan Industri Kujang Cikampek'])->update(['parent_company_code' => 'C000']);
        Company::where(['company_code' => 'D000', 'company_name' => 'PT Pupuk Kalimantan Timur'])->update(['parent_company_code' => 'A000']);
        Company::where(['company_code' => 'DA00', 'company_name' => 'PT Kaltim Industrial Estate'])->update(['parent_company_code' => 'D000']);
        Company::where(['company_code' => 'E000', 'company_name' => 'PT Pupuk Iskandar Muda'])->update(['parent_company_code' => 'A000']);
        Company::where(['company_code' => 'F000', 'company_name' => 'PT Pupuk Sriwidjaja Palembang'])->update(['parent_company_code' => 'A000']);
        Company::where(['company_code' => 'FA00', 'company_name' => 'PT Pusri Agro Lestari'])->update(['parent_company_code' => 'F000']);
        Company::where(['company_code' => 'G000', 'company_name' => 'PT Rekayasa Industri'])->update(['parent_company_code' => 'A000']);
        Company::where(['company_code' => 'GA00', 'company_name' => 'PT Yasa Industri Nusantara'])->update(['parent_company_code' => 'G000']);
        Company::where(['company_code' => 'GB00', 'company_name' => 'PT Tracon Industri'])->update(['parent_company_code' => 'G000']);
        Company::where(['company_code' => 'GC00', 'company_name' => 'PT Rekayasa Engineering'])->update(['parent_company_code' => 'G000']);
        Company::where(['company_code' => 'GE00', 'company_name' => 'REKIND Malaysia, Sdn, Bhd'])->update(['parent_company_code' => 'G000']);
        Company::where(['company_code' => 'GF00', 'company_name' => 'PT REKIND Daya Mamuju'])->update(['parent_company_code' => 'G000']);
        Company::where(['company_code' => 'GK00', 'company_name' => 'PT Puspetindo'])->update(['parent_company_code' => 'G000']);
        Company::where(['company_code' => 'H000', 'company_name' => 'PT Mega Eltra'])->update(['parent_company_code' => 'A000']);
        Company::where(['company_code' => 'HA00', 'company_name' => 'PT Sigma Utama'])->update(['parent_company_code' => 'H000']);
        Company::where(['company_code' => 'I000', 'company_name' => 'PT Pupuk Indonesia Logistik'])->update(['parent_company_code' => 'A000']);
        Company::where(['company_code' => 'J000', 'company_name' => 'PT Pupuk Indonesia Energi'])->update(['parent_company_code' => 'A000']);
        Company::where(['company_code' => 'JA00', 'company_name' => 'PT Kaltim Daya Mandiri'])->update(['parent_company_code' => 'J000']);
        Company::where(['company_code' => 'JAA0', 'company_name' => 'PT KDM Agro Energi'])->update(['parent_company_code' => 'J000']);
        Company::where(['company_code' => 'JAB0', 'company_name' => 'PT Banyumas Energi Lestari'])->update(['parent_company_code' => 'J000']);
        Company::where(['company_code' => 'K000', 'company_name' => 'PT Pupuk Indonesia Pangan'])->update(['parent_company_code' => 'A000']);
        Company::where(['company_code' => 'AAA0'])->delete();
        
        $this->command->info('UPdate Parent Company Seeders SuccessFull');
    }
}