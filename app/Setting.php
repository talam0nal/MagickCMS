<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	protected $fillable = [
		'value',
	];
	public $timestamps = false;

	public static function obtain($variable)
	{
		$item = Setting::where('variable', $variable)->pluck('value');
		if ( count($item) ) {
			foreach ($item as $val) {
				return $val;
			}
		}
	}

}