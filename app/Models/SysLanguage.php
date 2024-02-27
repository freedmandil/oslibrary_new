<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SysLanguage extends Model
{
    use HasFactory;
    protected $table = 'sys_languages';

    public function usr_users()
    {
        return $this->hasMany(UsrUser::class, 'language_id');
    }
}
