<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function orderitem(){
        return $this->hasMany(Orderitem::class,'jenis_barang_id','id');
    }
}
