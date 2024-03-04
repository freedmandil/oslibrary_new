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

    public function loc_shelf()
    {
        // Assuming Publisher model and publisher_id column in books table
        return $this->belongsTo(LocShelf::class, 'shelf_number_id');
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

    public function lib_authors()
    {
        return $this->hasMany(LibAuthorbookRelationship::class, 'book_id');
    }
    public static function BooksbyShelfname($shelf_name)
    {
        return self::select(
            'lib_books.id',
            'lib_titles.book_title as title',
            'lib_titles.book_subtitle as subtitle',
            'lib_books.book_edition AS edition',
            'lib_books.volume AS volume',
            'lib_books.volume_name AS volume_name',
            'lib_books.book_notes AS notes',
            'lib_books.book_type AS type',
            'tax_topics.name_en as topic_en',
            'tax_topics.name_he as topic_he',
            'lib_books.book_class_ref AS classRef',
            'lib_books.book_class_number AS classNumber',
            'lib_books.book_reference_id AS BookRef',
            'lib_books.sefer_number as seferNumber',
            'lib_books.barcode as barcode',
            'lib_books.loc_assignment_id AS assignmentId',
            'lib_books.date_updated as dateUpdated',
            'lib_publishers.name_en AS publisher_en',
            'lib_publishers.name_he AS publisher_he',
            'sys_languages.name_lan AS language',
            'loc_shelfnames.name AS shelfNumber',
            'loc_locations.name_en as assignment_en',
            'loc_locations.name_he as assignment_he',
            'lib_authors.last_name as author_last',
            'lib_authors.middle_name as author_middle',
            'lib_authors.first_name as author_first',
            'lib_authors.acronym as author_acronym',
            'sys_colors.color_name as color_name'
        )
            ->join('loc_shelfnames', 'lib_books.shelf_number_id', '=', 'loc_shelfnames.id')
            ->leftJoin('lib_titles', 'lib_books.id', '=', 'lib_titles.book_id')
            ->leftJoin('lib_publishers', 'lib_books.publisher_id', '=', 'lib_publishers.id')
            ->leftJoin('sys_languages', 'lib_books.language_id', '=', 'sys_languages.id')
            ->leftJoin('tax_topics', 'lib_books.book_topic_id', '=', 'tax_topics.id')
            ->leftJoin('lib_authorbook_relationship', 'lib_books.id', '=', 'lib_authorbook_relationship.book_id')
            ->leftJoin('lib_authors', 'lib_authorbook_relationship.author_id', '=', 'lib_authors.id')
            ->leftJoin('loc_assignments', 'lib_books.loc_assignment_id', '=', 'loc_assignments.id')
            ->leftJoin('loc_locations', 'loc_assignments.location_id', '=', 'loc_locations.id')
            ->leftJoin('sys_colors', 'loc_assignments.color_id', '=', 'sys_colors.id')
            ->where('loc_shelfnames.name', $shelf_name)
            ->get();
    }

    public static function BookbyId($id)
    {
        return self::select(
            '*',
            'lib_books.id',
            'lib_titles.book_title as title',
            'lib_titles.book_subtitle as subtitle',
            'lib_books.book_edition AS edition',
            'lib_books.volume AS volume',
            'lib_books.volume_name AS volume_name',
            'lib_books.book_notes AS notes',
            'lib_books.book_type AS type',
            'tax_topics.name_en as topic_en',
            'tax_topics.name_he as topic_he',
            'lib_books.book_class_ref AS classRef',
            'lib_books.book_class_number AS classNumber',
            'lib_books.book_reference_id AS BookRef',
            'lib_books.sefer_number as seferNumber',
            'lib_books.barcode as barcode',
            'lib_books.loc_assignment_id AS assignmentId',
            'lib_books.date_updated as dateUpdated',
            'lib_publishers.name_en AS publisher_en',
            'lib_publishers.name_he AS publisher_he',
            'sys_languages.name_lan AS language',
            'sys_languages.lan_code AS language_code',
            'loc_shelfnames.name AS shelfNumber',
            'loc_locations.name_en as assignment_en',
            'loc_locations.name_he as assignment_he',
            'lib_authors.last_name as author_last',
            'lib_authors.middle_name as author_middle',
            'lib_authors.first_name as author_first',
            'lib_authors.acronym as author_acronym',
            'sys_colors.color_name as color_name'
        )
            ->join('loc_shelfnames', 'lib_books.shelf_number_id', '=', 'loc_shelfnames.id')
            ->leftJoin('lib_titles', 'lib_books.id', '=', 'lib_titles.book_id')
            ->leftJoin('lib_publishers', 'lib_books.publisher_id', '=', 'lib_publishers.id')
            ->leftJoin('sys_languages', 'lib_books.language_id', '=', 'sys_languages.id')
            ->leftJoin('tax_topics', 'lib_books.book_topic_id', '=', 'tax_topics.id')
            ->leftJoin('lib_authorbook_relationship', 'lib_books.id', '=', 'lib_authorbook_relationship.book_id')
            ->leftJoin('lib_authors', 'lib_authorbook_relationship.author_id', '=', 'lib_authors.id')
            ->leftJoin('loc_assignments', 'lib_books.loc_assignment_id', '=', 'loc_assignments.id')
            ->leftJoin('loc_locations', 'loc_assignments.location_id', '=', 'loc_locations.id')
            ->leftJoin('sys_colors', 'loc_assignments.color_id', '=', 'sys_colors.id')
            ->where('lib_books.id', $id)
            ->first();
    }
}
