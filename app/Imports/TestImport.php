<?php

namespace App\Imports;

use App\Models\IntercoBatch;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TestImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            IntercoBatch::create([
                'entity_key'    => $row['entity_key'],
                'entity'        => $row['entity'],
                'time_key'      => $row['time_key'],
                'account_key'   => $row['account_key'],
                'account'       => $row['account'],
                'interco_key'   => $row['interco_key'],
                'interco'       => $row['interco'],
                'nilai'         => $row['nilai']
            ]);
        }
    }
}
