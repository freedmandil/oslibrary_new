<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibPublisher extends Model
{
    protected $fillable = [
        'name_en',
        'name_he',
        'address',
        'phone_number',
        'email',
        'city',
        'contact_status',
        'country_id',
    ];

    public $timestamps = false;

    use HasFactory;
}
