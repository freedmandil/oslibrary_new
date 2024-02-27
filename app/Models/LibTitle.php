<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibTitle extends Model
{
    protected $fillable = [
        'book_title',
        'book_subtitle',
        'book_sub_subtitle'
    ];
    public $timestamps = false;

    use HasFactory;
}