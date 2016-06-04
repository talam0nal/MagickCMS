<?php
	namespace App\Http\Controllers\Admin;

	use Eloquent;
	use Illuninate\Database\Eloquent\Model;
	use Request;
	use App\Order;
	use App\Cover;
	use App\Manager;
	use App\Status;

	class OrdersController extends BaseController 
	{

		public $route = 'orders';

		public function index()
		{
			$items = Order::all();
			foreach ($items as $item) {
				$item->date = date('j M Y', $item->date);
			}
			return view('admin.'.$this->route.'.index', [
				'items' => $items
			]);
		}

		public function create()
		{
			$item = new News;
			return view('admin.'.$this->route.'.edit', [
					'action' => 'store',
					'item' => $item,
				]);
		}

		public function store()
		{
			$item = new Order;
			$item->fill(Request::all());
			$date = Request::get('date');
			$timestamp = strtotime($date);
			$item->date = $timestamp;
			$item->save();
			return redirect()->route('admin.'.$this->route.'.edit', $item->id);
		}

		public function edit($id)
		{
			$item = Order::find($id);
			$manager = Manager::find($item->manager);
			$statuses = Status::get();
			$item->date = date('j M Y', $item->date);

			return view('admin.'.$this->route.'.edit', [
				'item'     => $item,
				'manager'  => $manager,
				'action'   => 'update',
				'statuses' => $statuses,
			]);
		}

		public function update($id)
		{
			$item = Order::find($id);
			$item->fill(Request::all());
			$item->save();
			return redirect()->back();
		}

		public function destroy($id)
		{
			Order::find($id)->delete();
		}

	}

?>