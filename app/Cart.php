<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;


class Cart extends Model
{
	/*
		Проверяет наличие товара в корзине
	*/
	static public function inBasket($id) 
	{
		$basket = Session::get('basket') ? : [];
		foreach ($basket as $item) {
			if ($item['id'] == $id)
				return true;
		}
		return false;
	}

	/*
		Список товаров в корзине
	*/
	public static function goodsInCart()
	{
		$basket = Session::get('basket') ?: [];
		$ids = [''];
		foreach ($basket as $item) {
			$ids[] = $item['id'];
		}
		$items = Good::bunch($ids)->get();
		foreach ($items as $obj) {
				$obj->count = 0;
				$rubric = Good::where('id',$obj->id)->first();
				$obj->url = Rubric::getURL($rubric->rubric).$obj->url;
				if ($obj->picture) {
					$obj->picture = Setting::obtain('imagePath').$obj->picture;
				} else {
					$obj->picture = null;
				}
				
			foreach ($basket as $item) {
				if ($item['id'] == $obj->id) {
					$obj->count = $item['count'];
					break;
				}
			}
		}		
		return $items;
	}

}