<?php
	namespace App\Http\Controllers\Admin;

	use Eloquent;
	use Illuninate\Database\Eloquent\Model;
	use Request;
	use App\Article;
	use App\Cover;
	use Image;

	class ArticlesController extends BaseController 
	{

		public $route = 'articles';

		public function index()
		{
			$items = Article::all();
			foreach ($items as $item) {
				$item->date = date('j M Y', $item->date);
			}
			return view('admin.'.$this->route.'.index', [
				'items' => $items
			]);
		}

		public function create()
		{
			$item = new Article;
			return view('admin.'.$this->route.'.edit', [
					'action' => 'store',
					'item' => $item,
				]);
		}

		public function store()
		{
			$item = new Article;
			$item->fill(Request::all());


			$cover = Cover::upload($this->route);
			if ($cover) {
				$item->cover = $cover;
			}
			
			$item->save();
			return redirect()->route('admin.'.$this->route.'.edit', $item->id);
		}

		public function edit($id)
		{
			$item = Article::find($id);


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

			$item = Article::find($id);
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
			Article::find($id)->delete();
		}

	}

?>