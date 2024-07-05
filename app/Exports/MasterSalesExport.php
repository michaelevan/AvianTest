<?php

namespace App\Exports;

use App\Models\MasterSales;
use Maatwebsite\Excel\Concerns\FromCollection;

class MasterSalesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MasterSales::all();
    }
}
