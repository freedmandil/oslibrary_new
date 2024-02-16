<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usrCat extends Model
{
    use HasFactory;

    protected $table = 'usr_cats';

    public function usr_users()
    {
        return $this->hasMany(UsrUser::class, 'cat_id');
    }
}
