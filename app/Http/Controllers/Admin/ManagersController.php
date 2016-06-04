<?php
	namespace App\Http\Controllers\Admin;

	use Eloquent;
	use Illuninate\Database\Eloquent\Model;
	use Request;
	use App\Manager;

	class ManagersController extends BaseController 
	{

		public $route = 'managers';

		public function index()
		{
			$items = Manager::all();

			return view('admin.'.$this->route.'.index', [
				'items' => $items
			]);
		}

		public function create()
		{
			$item = new Manager;
			return view('admin.'.$this->route.'.edit', [
					'action' => 'store',
					'item'   => $item,
				]);
		}

		public function destroy($id)
		{
			Manager::find($id)->delete();
		}

		public function store()
		{
			$item = new Manager;
			$item->fill(Request::all());
			$item->save();
			return redirect()->route('admin.'.$this->route.'.edit', $item->id);
		}

		public function edit($id)
		{
			$item = Manager::find($id);
			return view('admin.'.$this->route.'.edit', [
				'item'   => $item,
				'action' => 'update'
			]);
		}

		public function update($id)
		{
			$item = Manager::find($id);
			$item->fill(Request::all());
			$item->save();
			return redirect()->back();
		}

	}

?>