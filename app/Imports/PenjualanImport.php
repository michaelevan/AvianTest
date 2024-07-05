<?php

namespace App\Imports;

use App\Models\Penjualan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PenjualanImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Penjualan([
            'kode_toko' => $row['kode_toko'],
            'nominal_transaksi' => $row['nominal_transaksi'],
        ]);
    }
}
