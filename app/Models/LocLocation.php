<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocLocation extends Model
{
    use HasFactory;
    public function loc_assignments()
    {
        return $this->hasMany('App\Models\LocAssignment', 'location_id');
    }
}
