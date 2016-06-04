<?php
	namespace App\Http\Controllers\Admin;

	use Eloquent;
	use Illuninate\Database\Eloquent\Model;
	use Request;
	use App\Good;
	use App\Rubric;
	use BlueM\Tree;

	class GoodsController extends BaseController 
	{

		public $route = 'goods';

		public function index()
		{
			$items = Good::all();
			$count = Good::count();
			return view('admin.'.$this->route.'.index', [
				'items' => $items,
				'count' => $count,
			]);
		}

		public function create()
		{
			$item = new Good;
			return view('admin.'.$this->route.'.edit', [
					'action' => 'store',
					'item' => $item,
					'rubrics' => $this->getRubrics(),
				]);
		}

		public function store()
		{
			$item = new Good;
			$item->fill(Request::all());
			$rawPrice = Request::get('price');
			$item->price = str_replace(' ', '', $rawPrice);
			$item->save();
			return redirect()->route('admin.'.$this->route.'.edit', $item->id);
		}

		protected function getRubrics() 
		{
			$data = Rubric::all()->toArray();
			$tree = new Tree($data);
			return $tree->getNodes();
		}

		public function edit($id)
		{
			$item = Good::find($id);
			return view('admin.'.$this->route.'.edit', [
				'item' => $item,
				'action' => 'update',
				'rubrics' => $this->getRubrics(),
			]);
		}

		public function update($id)
		{
			$item = Good::find($id);
			$item->fill(Request::all());
			$rawPrice = Request::get('price');
			$visibility = Request::get('visible');
			$item->visible = $visibility ? 1 : 0;
			$item->price = str_replace(' ', '', $rawPrice);
			$item->save();
			return redirect()->back();
		}

		public function destroy($id)
		{
			Good::find($id)->delete();
		}

		public function unavailableImages()
		{
			$items = Good::where('picture', '')->get();
			foreach ($items as $item) {
				$item->url = Rubric::getURL($item->rubric);
			}
			return view('admin.statistics.unavailableimages', [
				'items' => $items,
				'count' => $items->count(),
			]);
		}

		public function withoutDescription()
		{
			$items = Good::where('text', '')->get();
			foreach ($items as $item) {
				$item->url = Rubric::getURL($item->rubric);
			}
			return view('admin.statistics.goods', [
				'items' => $items,
				'count' => $items->count(),
			]);
		}

	}

?>