<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = ['id', 'post_id', 'locale'];
}
