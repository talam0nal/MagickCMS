<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;

 
class Promotion extends Model
{
	protected $fillable = [
		'title',
		'text',
		'visible',
		'cover',
		'button_text',
		'link',
	];

	public function scopeVisible($query)
	{
		return $query->where('visible', 1);
	}

	public static function cached()
	{
		return Cache::rememberForever('promotions', function () {		
			$items = Promotion::visible()->get();
			return $items;
		});	
	}
	
}

