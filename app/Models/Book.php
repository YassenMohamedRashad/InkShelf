<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['title', 'description'];
    protected $guarded = ['id'];

    public function categories()
    {
        return $this->belongsToMany(Book_category::class, 'category_books', 'book_id', 'category_id');
    }
}
