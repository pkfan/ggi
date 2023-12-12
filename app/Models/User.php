<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;

use Laratrust\Contracts\LaratrustUser;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements LaratrustUser
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRolesAndPermissions;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'sr_code',
    //     'type',
    //     'roll'
    // ];

    protected $guarded = ['id'];

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
    ];
     public function claim()
    {
        return $this->hasOne('Claim');
    }

    // only for officers role
    public function targets(){
        return $this->hasMany(OfficerTarget::class, 'officer_id');
    }
}
