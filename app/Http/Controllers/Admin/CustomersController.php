<?php
	namespace App\Http\Controllers\Admin;

	use Eloquent;
	use Illuninate\Database\Eloquent\Model;
	use Request;
	use App\Customer;

	class CustomersController extends BaseController 
	{

		public $route = 'customers';

		public function index()
		{
			$items = Customer::all();

			return view('admin.'.$this->route.'.index', [
				'items' => $items
			]);
		}

		public function create()
		{
			$item = new Customer;
			return view('admin.'.$this->route.'.edit', [
					'action' => 'store',
					'item'   => $item,
				]);
		}

		public function destroy($id)
		{
			Customer::find($id)->delete();
		}

		public function store()
		{
			$item = new Customer;
			$item->fill(Request::all());
			$item->save();
			return redirect()->route('admin.'.$this->route.'.edit', $item->id);
		}

		public function edit($id)
		{
			$item = Customer::find($id);

			return view('admin.'.$this->route.'.edit', [
				'item'   => $item,
				'action' => 'update',

			]);
		}

		public function update($id)
		{
			$item = Customer::find($id);
			$item->fill(Request::all());
			$item->save();
			return redirect()->back();
		}

	}

?>