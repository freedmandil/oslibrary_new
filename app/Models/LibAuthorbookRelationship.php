<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibAuthorbookRelationship extends Model
{
    protected $table = 'lib_authorbook_relationship';

    use HasFactory;

    protected $fillable = [
        'book_id',
        'author_id',
    ];
}
