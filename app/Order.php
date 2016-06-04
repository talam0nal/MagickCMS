<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $fillable = [
		'title',
		'name',
		'phone',
		'date',
		'address',
		'status',
		'payment'
	];

    public function customers()
    {
        return $this->belongsToMany('App\Customer');
    }

}