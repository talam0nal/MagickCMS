<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;
use App\Setting;

class Album extends BaseModel
{
	protected $fillable = [
		'title',
		'text',
		'url',
		'page_description',
		'page_keywords',
		'visible',
		'cover',
	];
	
	public $timestamps = false;

	public function scopeWithURL($query, $url)
	{
		return $query->where('url', $url);
	}

	public function scopeVisible($query)
	{
		return $query->where('visible', 1);
	}

	public function photos()
	{
		return $this->morphMany('Photo', 'object');
	}


}