<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Sheet;

class Exportxls implements FromCollection,WithHeadings,ShouldAutoSize

{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(Collection $items,$columns=[])
	{
		$this->items=$items;
		$this->columns=$columns;
	}

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return $this->items;
    }

    public function headings(): array
    {
        if ($this->columns) return $this->columns;

        $firstRow = $this->items->first();

        if ($firstRow instanceof Arrayable || \is_object($firstRow)) {
            return array_keys(Sheet::mapArraybleRow($firstRow));
        }

        return $this->items->collapse()->keys()->all();
    }
}
