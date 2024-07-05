<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    // use HasFactory;
    protected $table = 'table_b';
    protected $primaryKey = 'kode_toko';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable =[
        'kode_toko',
        'nominal_transaksi',
    ];

    function tambahPenjualan($param) {
        $Penjualan = new Penjualan();
        $Penjualan->kode_toko = $param->kode_toko;
        $Penjualan->nominal_transaksi = $param->nominal_transaksi;
        $Penjualan->save();
        return $param;
    }

    function ubahPenjualan($param, $id){
        $Penjualan = Penjualan::findOrFail($id);
        $Penjualan->nominal_transaksi = $param->nominal_transaksi;
        $Penjualan->save();
        return $param;
    }

    function hapusPenjualan($param, $id){
        $Penjualan = Penjualan::findOrFail($id);
        $Penjualan->delete();
        return $param;
    }
}
