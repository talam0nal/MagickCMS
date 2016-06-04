<?php

namespace App\Http\Controllers;
use Request;
use Session;
use App\Page;
use Illuminate\Support\Facades\Auth;
use App\Customer;
use App\Status;
use Mail;
use App\Log;
use App\Setting;

class CustomerController extends BaseController
{

	/*
		Залогинивание пользователей
	*/
	public function login()
	{
		$attempt = Auth::guard('customers')->attempt([
			'email'    => Request::get('email'),
			'password' => Request::get('password'),
		]);
		if ($attempt) {
			return redirect()->route('home');
		} else {
			return redirect('/#fail');
		}
		
	}

	/*
		Разлогинивание пользователей
	*/
	public function logout()
	{
		Auth::guard('customers')->logout();
		return redirect()->route('home');
	}

	/*
		Форма логина для покупателей
	*/
	public function showLoginForm() 
	{
		$page = Page::cached('login');
		return view('frontend.pages.login', [
			'page' => $page,
		]);
	}

	/*
		Страница профиля
	*/
	public function profile() 
	{
		if (!Auth::guard('customers')->check() ) {
			return redirect()->route('login');
		}

		$id      = Auth::guard('customers')->user()->id;
		$email   = Auth::guard('customers')->user()->email;
		$name    = Auth::guard('customers')->user()->name;
		$phone   = Auth::guard('customers')->user()->phone;
		$address = Auth::guard('customers')->user()->address;
		$dealerClaim = Auth::guard('customers')->user()->dealerClaim;
		$type = Auth::guard('customers')->user()->type;
		
		$page = Page::cached('profile');
		return view('frontend.pages.profile', [
			'page'    => $page,
			'id'      => $id,
			'email'   => $email,
			'name'    => $name,
			'phone'   => $phone,
			'address' => $address,
			'dealerClaim' => $dealerClaim,
			'type'  => $type,
		]);
	}

	/*
		История покупок
	*/
	public function history() 
	{
		if (!Auth::guard('customers')->check() ) {
			return redirect()->route('login');
		}

		$page = Page::cached('history');
		$history = Customer::find(Auth::guard('customers')->user()->id)->orders()->get();
		foreach ($history as $item) {
			if ($item->status) {
				$item->statusText = Status::find($item->status)->title;
				$item->icon = Status::find($item->status)->icon;
			} else {
				$item->statusText = 'Ожидает обработки';
				$item->icon = 'fa-hourglass';

			}
		}
		return view('frontend.pages.history', [
			'page'    => $page,
			'history' => $history,
		]);
	}

	/*
		Регистрация нового пользователя
		-->post
	*/
	public function register()
	{
		Customer::create([
		            'email'    => Request::get('email'),
		            'password' => bcrypt(Request::get('password')),
		            'type'     => 1,
		]);
		return redirect('/#registerSuccess');
	}

	/*
		-->post
	*/
	public function dealerRegister()
	{

		$email = Request::get('email');
		$customer = Customer::exists($email);
		if ( $customer ) {
			$c = Customer::find($customer->id);
			$c->dealerClaim = 1;
			$c->save();

			$this->sendDealerNotificationToCustomer(Request::get('email'), false);
		} else {
			$password = rand(112345, 67891999);
			Customer::create([
			            'email'       => Request::get('email'),
			            'password'    => bcrypt($password),
			            'type'        => 1,
			            'name'        => Request::get('name'),
			            'phone'       => Request::get('phone'),
			            'company'     => Request::get('company'),
			            'address'     => Request::get('address'),
			            'dealerClaim' => 1,

			            
			]);
			$this->sendDealerNotificationToCustomer(Request::get('email'), $password);
		}

		$this->sendDealerNotificationToAdmin();

		return redirect('/#dealerSuccess');
	}

	public function sendDealerNotificationToAdmin()
	{
		/*
			Отправляем емаил уведомления админам и мееджерам
		*/
		$recipients = Setting::obtain('feedbackEmail');
		$recipients = explode(',', $recipients);
		foreach ($recipients as $email) {
			Mail::send('emails.dealer-admin', [
					'data'  => Request::all(),
				], function ($m) use ($email) {
				Log::write('EMAIL', $email);
				$m->from('talam0nal@yandex.ru', Setting::obtain('emailName'));
				$m->to(trim($email), 'Wellmet')->subject('Заявка на дилерство с сайта');
			});
		}
		
	}

	public function sendDealerNotificationToCustomer($email, $password)
	{
		Mail::send('emails.dealer-customer', [
				'password' => $password,
			], function ($m) use ($email) {
			Log::write('EMAIL', $email);
			$m->from('talam0nal@yandex.ru', Setting::obtain('emailName'));
			$m->to($email, 'Wellmet')->subject('Заявка на участие в дилерской программе Wellmet');
		});
	}

	/*
		Редактирования профиля
	*/
	public function update()
	{
		$item = Customer::find(Request::get('id'));
		$item->address = Request::get('address');
		$item->phone   = Request::get('phone');
		$item->name    = Request::get('name');
		$item->email   = Request::get('email');
		if (Request::get('password') ) {
			$item->password = bcrypt(Request::get('password'));
		}
		$item->save();
		return redirect('/profile#profileSuccess');
	}

	/*
		Страница формы регистрации
	*/
	public function showRegisterForm()
	{
		$page = Page::cached('register');
		return view('frontend.pages.register', [
			'page' => $page,
		]);		
	}



	public function dealer()
	{

		if (Auth::guard('customers')->check() ) {
			$id      = Auth::guard('customers')->user()->id;
			$email   = Auth::guard('customers')->user()->email;
			$name    = Auth::guard('customers')->user()->name;
			$phone   = Auth::guard('customers')->user()->phone;
			$address = Auth::guard('customers')->user()->address;			
		} else {
			$id      = false;
			$email   = false;
			$name    = false;
			$phone   = false;
			$address = false;				
		}



		return view('frontend.pages.dealer', [
			'page' => Page::cached('dealer'),
			'id'      => $id,
			'email'   => $email,
			'name'    => $name,
			'phone'   => $phone,
			'address' => $address,
			'company' => '',
		]);		
	}

}