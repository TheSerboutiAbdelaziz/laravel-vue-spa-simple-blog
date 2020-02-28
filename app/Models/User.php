<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{

    use HasApiTokens, Notifiable;


    //The attributes that are mass assignable.
    
    protected $fillable = [
        'name', 'email', 'password','avatar',
    ];


    //The attributes that should be hidden for arrays.

    protected $hidden = [
        'password', 'remember_token',
    ];


    //The attributes that should be cast to native types.

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    //Get the stories for the blog user.

    public function stories()
    {
        return $this->hasMany('App\Models\Story', 'author_id');
    }

    //Get the comments for the blog user.

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'author_id');
    }    

}
