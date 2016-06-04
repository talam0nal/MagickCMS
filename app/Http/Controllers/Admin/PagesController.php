<?php
	namespace App\Http\Controllers\Admin;

	use Eloquent;
	use Illuninate\Database\Eloquent\Model;
	use Request;
	use App\Page;
	use BlueM\Tree;

	class PagesController extends BaseController 
	{

		public $route = 'pages';

		public function index()
		{
			$items = $this->getNodes();
			return view('admin.'.$this->route.'.index', [
				'items' => $items
			]);
		}

		public function create()
		{
			$item = new Page;
			return view('admin.'.$this->route.'.edit', [
					'action' => 'store',
					'item' => $item,
					'nodes' => $this->getNodes(),
				]);
		}

		public function store()
		{
			$item = new Page;
			$item->fill(Request::all());
			$item->save();
			return redirect()->route('admin.'.$this->route.'.edit', $item->id);
		}

		protected function getNodes() 
		{
			$data = Page::all()->toArray();
			$tree = new Tree($data);
			return $tree->getNodes();
		}

		public function edit($id)
		{
			$item = Page::find($id);
			return view('admin.'.$this->route.'.edit', [
				'item' => $item,
				'nodes' => $this->getNodes(),
				'action' => 'update'
			]);
		}

		public function update($id)
		{
			$item = Page::find($id);
			$item->fill(Request::all());

			$visibility = Request::get('visible');
			$item->visible = $visibility ? 1 : 0;


			$menu = Request::get('top_menu');
			$item->top_menu = $menu ? 1 : 0;

			$item->save();
			return redirect()->back();
		}

		public function destroy($id)
		{
			Page::find($id)->delete();
		}

	}

?>