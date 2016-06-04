<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Contact;
use View;
use Request;
use Session;
use Cache;
use App\Page;
use App\Setting;

class BaseController extends Controller
{

	public function __construct() 
	{

		$this->rememberSpecialOrderParameters();

		View::share('contacts', $this->fetchContacts());
		View::share('settings', $this->fetchSettings());
		View::share('cart',     $this->getCart());
		View::share('topMenu',  $this->fetchTopMenu());
		View::share('query',    Request::get('query'));
	}

	public function rememberSpecialOrderParameters()
	{
		$scratch = Request::get('w_id');
		if (!is_null($scratch)) {
			Session::put('scratch', $scratch);
		}
	}

	public function fetchTopMenu()
	{
		return Cache::rememberForever('topMenu', function () {
			return Page::inTopMenu()->visible()->get();
		});
	}

	public function fetchContacts()
	{
		return Cache::rememberForever('contacts', function () {
			$items = Contact::get();
			foreach ($items as $key => $item) {
				$contacts[$item->variable] = $item->value;
			}
			$obj = (object) $contacts;
			return $obj;
		});
	}

	public function fetchSettings()
	{
		return Cache::rememberForever('settings', function () {
			$items = Setting::get();
			foreach ($items as $key => $item) {
				$settings[$item->variable] = $item->value;
			}
			$obj = (object) $settings;
			return $obj;
		});
	}

	public function getCart()
	{
		$cart = [];
		$cart['cost']  = CartController::getTotalCost();
		$cart['count'] = CartController::getTotalCount();
		$cart['word']  = CartController::get_goods_word(CartController::getTotalCount());
		$cart['word2'] = CartController::get_money_word(CartController::getTotalCost());
		return (Object) $cart;
	}
}