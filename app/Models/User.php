<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
        protected $table = 'users';
        protected $fillable = [
            'id',
            'name',
            'email',
            // 'user_name',
            'company_name',
            'staff_id',
            'password',
            'hourly_charges',
            'status',
            'user_type',
            'created_at',
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


    public function isAdmin()
    {
        return $this->user_type === 'admin';
    }

    public function isStaff()
    {
        return $this->user_type === 'staff';
    }

    // public function isManager()
    // {
    //     return $this->user_type === 'manager';
    // }
    public function isSuperAdmin()
    {
        return $this->user_type === 'super_admin';
    }

}
