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


    public function tax_subcategory()
    {
        // Assuming Publisher model and publisher_id column in books table
        return $this->belongsTo(TaxSubcat::class, 'subcategory_id');
    }
    public function tax_category()
    {
        // Assuming Publisher model and publisher_id column in books table
        return $this->belongsTo(TaxCategory::class, 'book_category_id');
    }

    public function tax_topic()
    {
        // Assuming Publisher model and publisher_id column in books table
        return $this->belongsTo(TaxTopic::class, 'book_topic_id');
    }

    public function tax_group()
    {
        // Assuming Publisher model and publisher_id column in books table
        return $this->belongsTo(TaxGroup::class, 'group_id');
    }

    public function sys_language()
    {
        // Assuming Publisher model and publisher_id column in books table
        return $this->belongsTo(SysLanguage::class, 'publisher_id');
    }

    public function loc_assignment()
    {
        // Assuming Publisher model and publisher_id column in books table
        return $this->belongsTo(LocAssignment::class, 'publisher_id');
    }

}
