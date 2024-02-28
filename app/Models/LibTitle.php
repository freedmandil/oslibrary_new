<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibTitle extends Model
{
    protected $fillable = [
        'book_id',
        'book_title',
        'book_subtitle',
        'book_sub_subtitle'
    ];
    public $timestamps = false;

    public function lib_book()
    {
        return $this->belongsTo(LibBook::class, 'book_id');
    }

    use HasFactory;
}
