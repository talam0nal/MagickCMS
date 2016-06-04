<?php
	namespace App\Http\Controllers\Admin;

	use Eloquent;
	use Illuninate\Database\Eloquent\Model;
	use Request;
	use App\News;
	use App\Cover;
	use Image;

	class NewsController extends BaseController 
	{

		public $route = 'news';

		public function index()
		{
			$items = News::all();
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
			$item = new News;
			$item->fill(Request::all());
			$date = Request::get('date');
			$timestamp = strtotime($date);
			$item->date = $timestamp;
			$item->save();
			return redirect()->route('admin.'.$this->route.'.edit', $item->id);
		}

		public function edit($id)
		{
			$item = News::find($id);
			$item->date = date('j M Y', $item->date);

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

			$item = News::find($id);
			$item->fill(Request::all());
			$visibility = Request::get('visible');
			$item->visible = $visibility ? 1 : 0;
			$date = Request::get('date');
			$timestamp = strtotime($date);
			$item->date = $timestamp;
			$cover = Cover::upload($this->route);
			if ($cover) {
				$item->cover = $cover;
			}
			
			$item->save();

			return redirect()->back();
		}

		public function destroy($id)
		{
			News::find($id)->delete();
		}

	}

?>