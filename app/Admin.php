<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\AdminNotification;

class Admin extends Authenticatable 
{
    use Notifiable;
    protected $guard = 'admin';
    protected $table = 'admins';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','name', 'password','phone','profile_image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function notifications(){
        return $this->morphMany(AdminNotification::class, 'notifiable')->orderBy('created_at', 'desc');
    }
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    
}
