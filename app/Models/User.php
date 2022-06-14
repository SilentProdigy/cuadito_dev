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

    public const APPROVED_STATUS = 1; 
    public const PENDING_STATUS = 0;
    public const DISAPPROVED_STATUS = 2;


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
        if( $this->status == self::APPROVED_STATUS ) 
        {
            return "<label class='label green'>APPROVED</label>";
        }
        
        if( $this->status == self::DISAPPROVED_STATUS )  
        {
            return "<label class='label red'>DISAPPROVED</label>";
        }

        if( $this->status == self::PENDING_STATUS )  
        {
            return "<label class='label gray'>WAITING FOR APPROVAL</label>";
        }
    }
}
