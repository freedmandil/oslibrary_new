<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibBook extends Model
{
    use HasFactory;

    protected $table = 'lib_books';

    // Assuming you have timestamps
    public $timestamps = true;

    // Relationship methods
    public function lib_title()
    {
        // Assuming you have an author_id column in your books table
        // and an Author model that relates to an authors table
        return $this->belongsTo(LibTitle::class, 'author_id');
    }

    public function lib_publisher()
    {
        // Assuming Publisher model and publisher_id column in books table
        return $this->belongsTo(LibPublisher::class, 'publisher_id');
    }

    public function sys_language()
    {
        // Assuming Publisher model and publisher_id column in books table
        return $this->belongsTo(SysLanguage::class, 'publisher_id');
    }

}
