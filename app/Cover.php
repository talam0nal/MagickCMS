<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Request;
use Image;

class Cover extends BaseModel
{

	protected $fillable = [
		'id'
	];

	private static $basePath = "uploads";

	public function coverable()
	{
		return $this->morphTo();
	}

	public static function upload($destination, $width = 500, $height = 400)
	{
		$file = Request::file('cover');
		if (!$file) {
			return null;
		}
		$name = $file->getClientOriginalName();

		#Путь куда мы сохраним файл


		$path = public_path('/'.self::$basePath.'/'.$destination.'/'.$name);
			
		$pathPreview = public_path('/'.self::$basePath.'/'.$destination.'/small_'.$name);
		$img = Image::make($file->getRealPath());
		$preview = Image::make($file->getRealPath());
		
		$preview->resize($width, $height, function ($constraint) use ($width, $height) {
			$constraint->aspectRatio();
			});//->resizeCanvas($width, $height, 'center', false);
		$preview->save($pathPreview);
		$img->save($path);
		return $name;
	}


}