<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibAuthor extends Model
{
    protected $fillable = [
        'prefix',
        'last_name',
        'first_name',
        'middle_name',
        'suffix',
        'acronym',
        'nickname',
        'type',
    ];

    use HasFactory;
    protected $table = 'lib_authors'; // Specify the table name if it's not the default
    public $timestamps = false;

    public function book()
    {
        return $this->belongsToMany(LibBook::class, 'lib_authorbook_relationship', 'author_id', 'book_id');
    }
}
