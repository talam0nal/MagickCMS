<?php
	namespace App\Http\Controllers\Admin;

	use Eloquent;
	use Illuninate\Database\Eloquent\Model;
	use Request;
	use App\News;
	use App\Cover;
	use Image;
	use App\Promotion;

	class PromotionsController extends BaseController 
	{

		public $route = 'promotions';

		public function index()
		{
			$items = Promotion::all();

			return view('admin.'.$this->route.'.index', [
				'items' => $items
			]);
		}

		public function create()
		{
			$item = new Promotion;
			return view('admin.'.$this->route.'.edit', [
					'action' => 'store',
					'item'   => $item,
				]);
		}

		public function store()
		{
			$item = new Promotion;
			$item->fill(Request::all());
			$date = Request::get('date');
			$item->save();
			return redirect()->route('admin.'.$this->route.'.edit', $item->id);
		}

		public function edit($id)
		{
			$item = Promotion::find($id);
			return view('admin.'.$this->route.'.edit', [
				'item' => $item,
				'action' => 'update'
			]);
		}

		protected function getCoverParams() 
		{		
			return Request::only('cover')['cover'] ? : [];
		}

		public function update($id)
		{

			$item = Promotion::find($id);
			$item->fill(Request::all());
			$visibility = Request::get('visible');
			$item->visible = $visibility ? 1 : 0;

			$cover = Cover::upload($this->route);
			if ($cover) {
				$item->cover = $cover;
			}
			
			$item->save();

			return redirect()->back();
		}

		public function destroy($id)
		{
			Promotion::find($id)->delete();
		}

	}

?>