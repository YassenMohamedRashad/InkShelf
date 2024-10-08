<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
