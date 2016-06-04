<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Article extends BaseModel
{
	protected $fillable = [
		'title',
		'text',
		'url',
		'page_description',
		'page_keywords',
		'cover',
		'description'
	];

	public function scopeVisible($query)
	{
		return $query->where('visible', 1);
	}

}