<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;
use App\Cart;

class Good extends Model
{
	protected $fillable = [
		'title',
		'text',
		'url',
		'page_description',
		'page_keywords',
		'rubric',
		'price',
		'description'
	];
	
	public $timestamps = false;

	public function scopeVisible($query)
	{
		return $query->worth()->where('visible', 1);
	}

	public function scopeRubric($query, $id)
	{
		return $query->where('rubric', $id);
	}

	public function scopeWithURL($query, $url)
	{
		return $query->where('url', $url);
	}

	public function scopeBunch($query, $list)
	{
		return $query->whereIn('id', $list);
	}

	public function scopePromoted($query)
	{
		return $query->where('hottext', '!=', "")->where('hottext', '!=', " ")->where('hottext', '!=', "NULL")->whereNotNull('hottext');
	}

	public static function rubricBySubgroupID($id)
	{
		$rubric = Rubric::withArticle($id)->first();
		return $rubric->id;
	}
	
	/*
		Товары с ценой не равной нулю
	*/
	public function scopeWorth($query)
	{
		return $query->where('price', '!=', 0);
	}

	public function scopeWithArticle($query, $id)
	{
		return $query->where('article', $id);
	}
	
	public static function withArticleExists($article)
	{
		return self::withArticle($article)->count();
	}

	public static function getFresh()
	{

		return Cache::rememberForever('freshGoods', function () {	
			$items = Good::orderBy('article', 'desc')->take(6)->get();
			foreach ($items as $item) {
				$item->description = nl2br($item->description);
				$item->url = Rubric::getURL($item->rubric).$item->url;
				$item->picture = Setting::obtain('imagePath').$item->picture;
				if (Cart::inBasket($item->id)) {
					$item->in_basket = 1;
				} else {
					$item->in_basket = 0;
				}
			}	
			return $items;	
		});

	}

	public static function getPopular()
	{
		return Cache::rememberForever('popularGoods', function () {	
			$items = Good::orderBy('sort', 'desc')->take(6)->get();
			foreach ($items as $item) {
				$item->description = nl2br($item->description);
				$item->url = Rubric::getURL($item->rubric).$item->url;
				$item->picture = Setting::obtain('imagePath').$item->picture;
				if (Cart::inBasket($item->id)) {
					$item->in_basket = 1;
				} else {
					$item->in_basket = 0;
				}
			}	
			return $items;	
		});

	}

	public static function getPromotions()
	{

		return Cache::rememberForever('promotionsGoods', function () {	
			$items = Good::orderBy('sort', 'desc')->promoted()->get()->take(6);
			foreach ($items as $item) {
				$item->description = nl2br($item->description);
				$item->url = Rubric::getURL($item->rubric).$item->url;
				$item->picture = Setting::obtain('imagePath').$item->picture;
				if (Cart::inBasket($item->id)) {
					$item->in_basket = 1;
				} else {
					$item->in_basket = 0;
				}
			}	
			return $items;	
		});

	}

}