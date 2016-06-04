<?php

namespace App\Http\Controllers;

use App\Page;
use App\News;
use App\Rubric;
use App\Setting;
use App\Http\Controllers\Controller;
use BlueM\Tree;
use Session;
use App\Good;
use Request;
use App\Order;
use App\Log;
use App\Customer;
use App\SMS;
use Mail;
use XmlParser;
use File;
use App\XML;
use App\Manager;
use DB;
use App\Helper;
use Cache;
use App\Promotion;
use App\Partner;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use App\Album;
use App\Photo;
use App\Article;


class PagesController extends BaseController
{

	/*
		Главная страница
	*/
	public function index() 
	{

		return view('frontend.pages.main', [
			'news'            => News::forMain(),
			'page'            => Page::main(),
			'rubrics'         => Rubric::getAllNoded(),
			'firstRubric'     => Rubric::firstInList(),
			'promotions'      => Promotion::cached(),
			'promotionsGoods' => Good::getPromotions(),
			'popularGoods'    => Good::getPopular(),
			'freshGoods'      => Good::getFresh(),
			'partners'        => Partner::cached(),
		]);
		
	}

	/*
		Сертификаты
	*/
	public function certificates()
	{
		$page = Page::cached('сертификаты');
		return view('frontend.pages.certificates', [
			'page' => $page
		]);		
	}

	public function gallery()
	{
		$page = Page::cached('gallery');
		$items = Album::get();
		return view('frontend.pages.gallery', [
			'page' => $page,
			'items' => $items,
		]);			
	}

	public function galleryShow($url)
	{

		$page = Album::where('url', $url)->first();
		$photos = Photo::where('object_id', $page->id)->where('object_type', 'Album')->get();
		$items = Album::get();
		return view('frontend.pages.album', [
			'page' => $page,
			'items' => $items,
			'photos' => $photos,
		]);			
	}

	public function articles()
	{
		$page = Page::cached('articles');
		$items = Article::get();
		return view('frontend.pages.articles', [
			'page' => $page,
			'items' => $items,
		]);			
	}

	public function articleShow($url)
	{
		$page = Article::where('url', $url)->first();
		return view('frontend.pages.article', [
			'page' => $page,
		]);			
	}

	/*
		Поиск по сайту
	*/
	public function search()
	{
		$query = Request::get('query');
		$page = Page::cached('search');
		$page->description = 'Результаты поиска по запросу: '.$query;
		$products = Good::where('title', 'like', $query.'%')->visible()->get();
		$foundedRubrics  = Rubric::where('title', 'like', $query.'%')->visible()->get();

		foreach ($foundedRubrics as $item) {
			$item->url = Rubric::getURL($item->id);
			$item->picture = Setting::obtain('imagePath').$item->picture;
		}	

		foreach ($products as $item) {
			$item->description = nl2br($item->description);
			$item->url = Rubric::getURL($item->rubric).$item->url;
			$item->picture = Setting::obtain('imagePath').$item->picture;
			if (CartController::inBasket($item->id)) {
				$item->in_basket = 1;
			} else {
				$item->in_basket = 0;
			}
		}
		return view('frontend.pages.search', [
			'page'           => $page,
			'products'       => $products,
			'foundedRubrics' => $foundedRubrics,
			'breadcrumbs'    => [],
			'rubrics'        => Rubric::getAllNoded(),
		]);
	}

	/*
		Страница контактов
	*/
	public function contacts()
	{
		$page = Page::cached('contacts');
		return view('frontend.pages.contacts', [
			'page' => $page
		]);
	}

	/*
		Печать контактов
	*/
	public function printContacts()
	{
		$page = Page::cached('contacts');
		return view('frontend.pages.print', [
			'page' => $page
		]);
	}


	/*
		Страница оформления заказа
	*/
	public function order()
	{
		$page = Page::cached('order');
		return view('frontend.pages.order', [
			'page'  => $page,
			'items' => Cart::goodsInCart(),
		]);
	}

	/*
		Страница оплаты заказа
	*/
	public function payment()
	{
		$page = Page::cached('payment');
		return view('frontend.pages.payment', [
			'page'  => $page,
		]);
	}

	/*
		Сохранение заказа в базе
	*/
	public function storeOrder()
	{
		$goods = Cart::goodsInCart();

		foreach ($goods as $item) {
			$text  = $item->title;
			$text .= ', стоимость ';
			$text .= $item->price.' руб., ';
			$text .= 'количество '.$item->count;
			$text .= ' на сумму '. $item->price * $item->count. ' руб.';
			$text .= '<br><br>';
		}

		$order = new Order;
		$order->address  = Request::get('address');
		$order->email    = Request::get('email');
		$order->phone    = Request::get('phone');
		$order->name     = Request::get('name');
		$order->comments = Request::get('comments');

		if (is_null(Session::get('scratch')) ) {
			$order->scratch = '';
		} else {
			$order->scratch = Session::get('scratch');
		}
		
		$managerEmail = Manager::scratchProcess($order->scratch);

		$order->items = $text;
		
		$order->manager = Manager::mail($managerEmail)->first()->id;
		$order->status = 0;
		$order->payment = 0;
		$order->save();

		if ($order->phone && Setting::obtain('smsSending') == '1') {
			SMS::send($order->phone, Setting::obtain('thanks').' Ваш номер заказа '.$order->id);
		}

		/*
			Если пользователь с таким емайлом уже существует, 
			то сохраняем запись в истории покупок
		*/
		$password = false; 
		if ( Customer::exists($order->email)  ) {
			$customerID = Customer::exists($order->email)->id;
			
			/*	
				Сохраняем заказ в истории покупок
			*/
			DB::table('customer_order')->insert([
				'customer_id' => $customerID,
			    'order_id'    => $order->id
			]);

		} else {
			/*
				Если же такого пользователя нет, то
				создаём новый аккаунт с рандомным паролем
			*/
			$password = rand(112345, 67891999);
			$customer = Customer::create([
			            'email'    => $order->email,
			            'name'     => $order->name,
			            'phone'    => $order->phone,
			            'address'  => $order->address,
			            'password' => bcrypt($password),
			            'type'     => 1
			]);

			/*	
				Сохраняем заказ в истории покупок
			*/
			DB::table('customer_order')->insert([
				'customer_id' => $customer->id,
			    'order_id'    => $order->id
			]);

			
		}
		

		/*
			Отправляем емаил уведомления админам и мееджерам
		*/
		$recipients = Setting::obtain('feedbackEmail').','.$managerEmail;
		$recipients = explode(',', $recipients);
		foreach ($recipients as $email) {
			Mail::send('emails.order', [
					'data'  => Request::all(),
					'items' => $text
				], function ($m) use ($email) {
				Log::write('EMAIL', $email);
				$m->from('talam0nal@yandex.ru', Setting::obtain('emailName'));
				$m->to(trim($email), 'Wellmet')->subject('Новый заказ на сайте');
			});
		}

		/*
			Отправляем уведомление пользвателю
		*/
		Mail::send('emails.notification', [
				'data'     => Request::all(),
				'items'    => $text,
				'password' => $password
			], function ($m) use ($email) {
			Log::write('EMAIL', $email);
			$m->from('talam0nal@yandex.ru', Setting::obtain('emailName'));
			$m->to(trim(Request::get('email')), 'Wellmet')->subject(Setting::obtain('thanks'));
		});

		Session::forget('basket');
		return redirect('/#orderSuccess');
	}

	/*
		Отправляет письмо из формы обратной связи
	*/
	public function sendFeedback()
	{
		$recipients = Setting::obtain('feedbackEmail');
		$recipients = explode(',', $recipients);
		foreach ($recipients as $email) {
			Mail::send('emails.feedback', [
					'data' => Request::all()
				], function ($m) use ($email) {
				Log::write('EMAIL', $email);
				$m->from('talam0nal@yandex.ru', Setting::obtain('emailName'));
				$m->to(trim($email), 'Wellmet')->subject('Сообщение из формы обратной связи');
			});
		}
		return redirect('/#feedbackSuccess');
	}

	/*
		Статическая страница
	*/
	public function show($url)
	{
		$page = Page::cached($url);
		return view('frontend.pages.show', [
				'page' => $page
		]);
	}



}