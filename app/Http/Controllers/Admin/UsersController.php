<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Request;
use Session;
use App\Page;
use Auth;
use App\User;

class UsersController extends Controller
{

	public function login()
	{
		
		$attempt = Auth::guard('users')->attempt([
			'email'    => Request::get('email'),
			'password' => Request::get('password'),
		]);

		if (Auth::guard('users')->check() ) {
			return redirect('/admin');
		}
		

		
	}

	public function logout()
	{
		Auth::guard('users')->logout();
		return redirect()->route('home');
	}

	/*
		Форма логина для пользователей панели управления
	*/
	public function showLoginForm() 
	{

		return view('auth.login');
	}

}