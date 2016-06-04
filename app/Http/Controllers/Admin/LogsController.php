<?php
	namespace App\Http\Controllers\Admin;

	use Eloquent;
	use Illuninate\Database\Eloquent\Model;
	use Request;
	use App\Setting;
	use App\Log;


	class LogsController extends BaseController 
	{

		public $route = 'logs';

		public function index()
		{
			$items = Log::orderBy('id', 'desc')->take(300)->get();
			return view('admin.'.$this->route.'.index', [
				'items' => $items
			]);
		}

	}

?>