<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderitem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function jenis(){
        return $this->belongsTo(JenisBarang::class,'jenis_barang_id','id');
    }
}
