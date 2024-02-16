<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sysCountry extends Model
{
    use HasFactory;

    protected $table = 'sys_countries';

    public function usr_users()
    {
        return $this->hasMany(UsrUser::class, 'country_id');
    }
}
