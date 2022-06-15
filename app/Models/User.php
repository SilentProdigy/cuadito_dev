<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ACTIVE_STATUS = 1; 
    public const INACTIVE_STATUS = 0;

    public const USER_ROLE = "user";
    public const ADMIN_ROLE = "admin";
    public const ROLES = [self::USER_ROLE, self::ADMIN_ROLE];


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status'
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
    ];

    public function getStatusBadgeAttribute()
    {
        if( $this->status == self::ACTIVE_STATUS ) 
        {
            return "<span class='badge rounded-pill bg-success'>APPROVED</span>";
        }
        
        if( $this->status == self::INACTIVE_STATUS )  
        {
            return "<span class='badge rounded-pill bg-danger'>DISAPPROVED</span>";
        }
    }
}
