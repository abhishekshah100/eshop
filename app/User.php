<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'email','date_birth','password','first_name','last_name','address','phone','city','state','pincode','verification_code','user_status','newsletter_subscription','provider_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setFirstNameAttribute($value)
    {
            $this->attributes['first_name'] = ucwords(strtolower($value));
            $this->attributes['user_name'] = strtolower(str_replace(" ", "", $value));
    }

    public function setLastNameAttribute($value)
    {
            $this->attributes['last_name'] = ucwords(strtolower($value));
    }

    public function setEmailAttribute($value)
    {
            $this->attributes['email'] = strtolower($value);
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
