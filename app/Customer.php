<?php

namespace App;
 
use Illuminate\Foundation\Auth\User as Authenticatable;
 
class Customer extends Authenticatable
{

	protected $guard = "customers";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'type',
        'company',
        'dealerClaim'
    ];
 
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'id'
    ];

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }

    /*
        Поиск пользователя по email
    */
    public function scopeWithEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public static function exists($email)
    {
        return Customer::withEmail($email)->first();
    }

}

