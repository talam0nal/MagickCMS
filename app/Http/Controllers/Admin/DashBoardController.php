<?php
	namespace App\Http\Controllers\Admin;
	use App\Http\Controllers\Controller;
	use Auth;
	use App\User;
	use Request;
	use Session;
	use Cache;

	class DashboardController extends BaseController
	{
		public function index() 
		{
 
			return view('admin.dashboard');

		}

		public function php()
		{
			return view('admin.statistics.php');
		}

		public function cleanCache()
		{

			Cache::flush();
			return view('admin.statistics.cache');
		}

	}

?>
