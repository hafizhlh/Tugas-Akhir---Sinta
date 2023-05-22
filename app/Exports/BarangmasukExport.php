<?php

namespace App\Exports;


use App\Models\BarangMasuk;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class BarangmasukExport implements FromQuery
{
    use Exportable;
    protected $date ='';    
    protected $year ='';

    public function __construct($date, $year)
    {
        $this->date = $date;
        $this->year = $year;
        return $this;
    }
    

    public function query()
    {
       

            
        return BarangMasuk::query()
        ->join('detail_barang_masuks', 'detail_barang_masuks.barang_masuk_id', '=', 'barang_masuks.barang_masuk_id')
            ->join('barangs', 'detail_barang_masuks.barang_id', '=', 'barangs.barang_id')
        ->whereMonth('tanggal_barang_masuk', $this->date);

    }
   
}
