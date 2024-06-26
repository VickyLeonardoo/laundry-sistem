<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function voucher(){
        return $this->hasMany(Voucher::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }
}
