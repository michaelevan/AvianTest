<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSales extends Model
{
    // use HasFactory;
    protected $table = 'table_d';
    protected $primaryKey = 'kode_sales';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable =[
        'kode_sales',
        'nama_sales',
    ];

    function tambahMasterSales($param) {
        $MasterSales = new MasterSales();
        $MasterSales->kode_sales = $param->kode_sales;
        $MasterSales->nama_sales = $param->nama_sales;
        $MasterSales->save();
        return $param;
    }

    function ubahMasterSales($param, $id){
        $MasterSales = MasterSales::findOrFail($id);
        $MasterSales->nama_sales = $param->nama_sales;
        $MasterSales->save();
        return $param;
    }

    function hapusMasterSales($param, $id){
        $MasterSales = MasterSales::findOrFail($id);
        $MasterSales->delete();
        return $param;
    }
}
