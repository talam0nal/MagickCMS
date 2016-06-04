<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;


class Page extends Model
{
	protected $fillable = [
		'title',
		'text',
		'url',
		'page_description',
		'page_keywords',
		'parent',
		'visible',
		'top_menu',
	];
	
	public $timestamps = false;

	public function scopeWithURL($query, $url)
	{
		$query->where('url', $url);
	}

	/*
		Главная страница
	*/
	public static function main()
	{
		return Cache::rememberForever('mainPage', function () {		
			return Page::withURL('index')->firstOrFail();
		});		
	}

	/*
		Любая страница
	*/
	public static function cached($url)
	{
		return Cache::rememberForever('page'.$url, function () use ($url) {		
			return Page::withURL($url)->firstOrFail();
		});		
	}

	/*
		Корневая страница каталога товаров
	*/
	public static function catalog()
	{
		return Cache::rememberForever('catalog', function () {		
			return Page::withURL('catalog')->firstOrFail();
		});			
	}

	public function scopeVisible($query)
	{
		return $query->where('visible', 1);
	}

	public function scopeInTopMenu($query)
	{
		return $query->where('top_menu', 1);
	}

}