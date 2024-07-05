<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaSales extends Model
{
    // use HasFactory;
    protected $table = 'table_c';
    protected $primaryKey = 'kode_toko';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable =[
        'kode_toko',
        'area_sales',
    ];

    function tambahAreaSales($param) {
        $AreaSales = new AreaSales();
        $AreaSales->kode_toko = $param->kode_toko;
        $AreaSales->area_sales = $param->area_sales;
        $AreaSales->save();
        return $param;
    }

    function ubahAreaSales($param, $id){
        $AreaSales = AreaSales::findOrFail($id);
        $AreaSales->area_sales = $param->area_sales;
        $AreaSales->save();
        return $param;
    }

    function hapusAreaSales($param, $id){
        $AreaSales = AreaSales::findOrFail($id);
        $AreaSales->delete();
        return $param;
    }
}
