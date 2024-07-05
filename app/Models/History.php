<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    // use HasFactory;
    protected $table = 'table_a';
    protected $primaryKey = 'kode_toko_baru';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable =[
        'kode_toko_baru',
        'kode_toko_lama',
    ];

    function tambahHistori($param) {
        $History = new History();
        $History->kode_toko_baru = $param->kode_toko_baru;
        $History->kode_toko_lama = $param->kode_toko_lama;
        $History->save();
        return $param;
    }

    function ubahHistori($param, $id){
        $history = History::findOrFail($id);
        $history->kode_toko_lama = $param->kode_toko_lama;
        $history->save();
        return $param;
    }

    function hapusHistori($param, $id){
        $history = History::findOrFail($id);
        $history->delete();
        return $param;
    }
}
