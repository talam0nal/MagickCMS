<?php
	namespace App\Http\Controllers\Admin;

	use Eloquent;
	use Illuninate\Database\Eloquent\Model;
	use Request;
	use App\News;
	use App\Cover;
	use Image;
	use App\Promotion;
	use App\Partner;

	class PartnersController extends BaseController 
	{

		public $route = 'partners';

		public function index()
		{
			$items = Partner::all();

			return view('admin.'.$this->route.'.index', [
				'items' => $items
			]);
		}

		public function create()
		{
			$item = new Partner;
			return view('admin.'.$this->route.'.edit', [
					'action' => 'store',
					'item'   => $item,
				]);
		}

		public function store()
		{
			$item = new Partner;
			$item->fill(Request::all());
			$date = Request::get('date');
			$item->save();
			return redirect()->route('admin.'.$this->route.'.edit', $item->id);
		}

		public function edit($id)
		{
			$item = Partner::find($id);
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

			$item = Partner::find($id);
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
			Partner::find($id)->delete();
		}

	}

?>