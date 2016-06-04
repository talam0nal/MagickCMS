<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Status extends BaseModel
{
	protected $fillable = [
		'title',
	];

	public $timestamps = false;
	protected $table = 'statuses';

}