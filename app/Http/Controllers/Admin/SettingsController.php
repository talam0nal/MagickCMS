<?php
	namespace App\Http\Controllers\Admin;

	use Eloquent;
	use Illuninate\Database\Eloquent\Model;
	use Request;
	use App\Setting;


	class SettingsController extends BaseController 
	{

		public $route = 'settings';

		public function index()
		{
			$items = Setting::all();
			return view('admin.'.$this->route.'.index', [
				'items' => $items
			]);
		}

		public function edit($id)
		{
			$item = Setting::find($id);
			return view('admin.'.$this->route.'.edit', [
				'item' => $item,
				'action' => 'update'
			]);
		}

		public function update($id)
		{
			$item = Setting::find($id);
			$item->fill(Request::all());
			$item->save();
			return redirect()->back();
		}

	}

?>