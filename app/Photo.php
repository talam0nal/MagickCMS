<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;
use App\Cart;
use Request;
use Image;

class Photo extends Model
{
	protected $fillable = [
		'image',
	];

	private static $basePath = "uploads";



	public function objectable() 
	{
		return $this->morphTo();
	}

	public static function upload($destination, $width = 500, $height = 400)
	{
		$files = Request::file('files');

		$names = [];
		foreach ($files as $key => $file) {

			$name = $file->getClientOriginalName();
			
			$path = public_path('/'.self::$basePath.'/'.$destination.'/'.$name);
				
			$pathPreview = public_path('/'.self::$basePath.'/'.$destination.'/small_'.$name);
			$img = Image::make($file->getRealPath());
			$preview = Image::make($file->getRealPath());
			
			$preview->resize($width, $height, function ($constraint) use ($width, $height) {
				$constraint->aspectRatio();
				});
			$preview->save($pathPreview);
			$img->save($path);
			$names[] =  $name;
		}

		return $names;

	}

}