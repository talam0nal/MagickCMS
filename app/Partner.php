<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;

 
class Partner extends Model
{
	protected $fillable = [
		'title',
		'cover',
	];

	public function scopeVisible($query)
	{
		return $query->where('visible', 1);
	}

	public static function cached()
	{
		return Cache::rememberForever('partners', function () {		
			$items = Partner::visible()->get();
			return $items;
		});	
	}
	
}

