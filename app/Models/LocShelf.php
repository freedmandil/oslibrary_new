<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocShelf extends Model
{
    protected $fillable = [
        'name',
        'number',
        'prefix',
        'suffix',
    ];

    protected $table = 'loc_shelfnames';
    public $timestamps = false;

    use HasFactory;
}
