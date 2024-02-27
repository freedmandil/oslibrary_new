<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocAssignment extends Model
{
    protected $table = 'loc_assignments';

    use HasFactory;

    public $timestamps = false;

    public function loc_location()
    {
        // Assuming you have an author_id column in your books table
        // and an Author model that relates to an authors table
        return $this->belongsTo(LocLocation::class, 'location_id');
    }
    public function sys_color()
    {
        // Assuming you have an author_id column in your books table
        // and an Author model that relates to an authors table
        return $this->belongsTo(SysColor::class, 'color_id');
    }
}
