<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibBook extends Model
{
    use HasFactory;

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    protected $table = 'lib_books';
    protected $fillable = [
        'book_edition',
        'volume',
        'volume_name',
        'book_notes',
        'book_type',
        'book_topic_id',
        'book_category_id',
        'subcategory_id',
        'group_id',
        'book_class_ref',
        'book_class_number',
        'book_reference_id',
        'language_id',
        'shelf_number_id',
        'sefer_number',
        'barcode',
        'loc_assignment_id',
        'publisher_id',
        'date_of_publication',
        'publication_location',
    ];

    // Assuming you have timestamps
    public $timestamps = true;

    // Relationship methods
    public function lib_titles()
    {
        return $this->hasMany(LibTitle::class, 'book_id');
    }

    public function loc_shelfname()
    {
        // Assuming Publisher model and publisher_id column in books table
        return $this->belongsTo(LocShelfname::class, 'shelf_number_id');
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
        return $this->belongsTo(SysLanguage::class, 'language_id');
    }

    public function loc_assignment()
    {
        // Assuming Publisher model and publisher_id column in books table
        return $this->belongsTo(LocAssignment::class, 'loc_assignment_id');
    }

    public function lib_author()
    {
        return $this->belongsToMany(LibAuthor::class, 'lib_authorbook_relationship', 'book_id', 'author_id');
    }

}
