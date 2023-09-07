<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function discount(){
        return $this->belongsTo(Discount::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
