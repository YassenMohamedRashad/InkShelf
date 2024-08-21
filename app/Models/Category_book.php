<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_book extends Model
{
    use HasFactory;
    protected $table = 'category_books';
    protected $guarded = ['id'];



}
