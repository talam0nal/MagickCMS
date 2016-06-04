<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Log;

class Log extends Model
{
	public static function write($type, $data)
	{
		$item = new Log;
		$item->data = $data;
		$item->type = $type;
		$item->save();
	}	
}