<?php

namespace App\Http\Controllers;
use Request;
use Session;
use App\Good;
use App\Page;
use App\Rubric;
use App\Setting;
use App\Cart;

class CartController extends BaseController {

	/*
		Добавляет товар в корзину
	*/
	public function addToCart() 
	{
		$id = Request::input('id');
		$count  = 1;
		$basket = Request::session()->get('basket');
		if ($id) {
			if (!$this->inBasket($id, $basket)) {
				$price = Good::find($id)->price;
				$basket[] = [
					'id'    => $id,
					'count' => $count,
					'price' => $price, 
				];
				Request::session()->put('basket', $basket);
			}
		}
		$totalCost = $this->output_numbers(CartController::getTotalCost());
		return [
			'total_count' => CartController::getTotalCount(),
			'total_cost'  => $totalCost,
			'word'        => CartController::get_goods_word(CartController::getTotalCount()),
		];
	}

	/*
		Удаляет товар из корзины
	*/	
	public function deleteFromCart() 
	{
		$id = Request::input('id');
		if ($id) {
			$basket = Session::get('basket');
			foreach ($basket as $k => $item) {
				if ($item['id'] == $id)
					unset($basket[$k]);
			}
			Session::put('basket', $basket);
		}
		return [
			'total_count' => CartController::getTotalCount(),
			'total_cost'  => $this->output_numbers(CartController::getTotalCost()),
			'word'        => CartController::get_goods_word(CartController::getTotalCount())
		];
	}

	/*
		Пересчитывает товары в корзине
	*/
	public function updateCount()
	{
		$id = Request::input('id');
		$count = Request::input('count');
		$basket = Session::get('basket');
		$item_count = 0;
		if ($id) {
			foreach ($basket as $k => $item) {
				if ($item['id'] == $id) {
					$basket[$k]['count'] = $item['count'] + $count;
					$item_count = $basket[$k]['count'];
					$item_cost = $item_count * $item['price'];
					break;
				}
			}	
			Session::put('basket', $basket);
		}
		return [
			'item_count'  => $item_count,
			'total_count' => CartController::getTotalCount(),
			'total_cost'  => $this->output_numbers(CartController::getTotalCost()),
			'item_cost'   => $item_cost
		];
	}

	/*
		Страница корзины
	*/
	public function cart()
	{
		$page = Page::cached('cart');
		return view('frontend.pages.cart', [
			'page'  => $page,
			'items' => Cart::goodsInCart(),
		]);
	}



	/*
		Возвращает айдишники товаров, которые находятся в корзине
	*/
	public static function retrieveCartItems() 
	{
		$basket = Session::get('basket') ?: [];
		$ids = [];
		foreach ($basket as $item) {
			$ids[] = $item['id'];
		}
		return $ids;
	}

	static public function getTotalCount()
	{		
		$basket = Session::get('basket') ? : [];
		$count = 0;
		foreach ($basket as $item) {
			$count += $item['count'];
		}
		return $count;
	}

	/*
		Возращает общую цену товаров в корзине
	*/
	static public function getTotalCost() 
	{
		$basket = Session::get('basket') ? : [];
		$cost = 0;
		foreach ($basket as $item) {
			$cost += $item['price'] * $item['count'];
		}
		return $cost;
	}

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
		Склонение числительных
	*/
	protected function output_numbers($value, $word = 1) 
	{
		$new_value = '';
		$orig_value = $value;
		$flag = 0;
		while ($value) {
			if (strlen($value) < 3) {
				$s = substr($value, -strlen($value));
				$flag = 1;
			}
			else {
				$s = substr($value, -3);
			}	
			if (!$new_value) $new_value = $s;
			else
				$new_value = $s.' '.$new_value;
			if ($flag) {
				break;
			}
			else {
				$l = strlen($value) - 3;
				$value = substr($value, 0, $l);
			}
		}

		if ($new_value) {
			if ($word == 1)
				return $new_value.' '.CartController::get_money_word($orig_value);
			elseif ($word == 3)
				return $new_value.' '.$this->get_contacts_word($orig_value);
			return $new_value;
		}
		else
			return 0;
	}

	/*
		Склонение числительных для слова "рубль"
	*/
	public static function get_money_word($count) 
	{
		if ($count % 10 == 1 && $count % 100 != 11)
			$res = 'рубль';
		elseif ( ( $count % 10 == 2 || $count % 10 == 3 || $count % 10 == 4) && $count % 100 != 12 && $count % 100 != 13 && $count % 100 != 14 ) 
			$res = 'рубля';
		else
			$res = 'рублей';
		return $res;
	}

	/*
		Склонение числительных для слова "товар"
	*/
	public static function get_goods_word($count) 
	{
		if ($count % 10 == 1 && $count % 100 != 11)
			$res = 'товар';
		elseif ( ( $count % 10 == 2 || $count % 10 == 3 || $count % 10 == 4 ) && $count % 100 != 12 && $count % 100 != 13 && $count % 100 != 14 ) 
			$res = 'товара';
		else
			$res = 'товаров';
		return $res;
	}

}