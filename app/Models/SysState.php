<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sysState extends Model
{
    use HasFactory;

    protected $table = 'sys_states';

    public function usr_users()
    {
        return $this->hasMany(UsrUser::class, 'state_id');
    }

}
