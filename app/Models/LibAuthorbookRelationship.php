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

    public $timestamps = false;

    public function AuthorIdsByBookId($book_id)
    {
        return $this->select('author_id')->where('book_id', $book_id)->get();
    }

    public function lib_book()
    {
        return $this->belongsTo(LibBook::class, 'book_id');
    }

    public function lib_author()
    {
        return $this->belongsTo(LibAuthor::class, 'author_id');
    }

}
