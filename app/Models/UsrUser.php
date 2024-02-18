<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Model;

class usrUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usr_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'email_verified_at',
        'password',
        'first_name',
        'last_name',
        'alt_name',
        'email2',
        'phone1',
        'phone2',
        'address1',
        'address2',
        'address3',
        'city',
        'state_id',
        'country_id',
        'zip_post_code',
        'rememberToken',
        'cat_id',
        'access_level',
        'date_created',
        'contact_status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    // User belongs to a usr_cats
    public function usr_cats()
    {
        return $this->belongsTo(usr_cats::class, 'cat_id');
    }

    // User belongs to a sys_country
    public function sys_country()
    {
        return $this->belongsTo(sys_countries::class, 'country_id');
    }

}
