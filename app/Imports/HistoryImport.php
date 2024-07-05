<?php

namespace App\Imports;

use App\Models\History;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HistoryImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new History([
            'kode_toko_baru' => $row['kode_toko_baru'],
            'kode_toko_lama' => $row['kode_toko_lama'],
        ]);
    }
}
