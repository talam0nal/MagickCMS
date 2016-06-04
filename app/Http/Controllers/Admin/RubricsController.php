<?php
	namespace App\Http\Controllers\Admin;

	use Eloquent;
	use Illuninate\Database\Eloquent\Model;
	use Request;
	use App\Rubric;
	use BlueM\Tree;
	use App\Good;

	class RubricsController extends BaseController 
	{

		public $route = 'rubrics';

		public function index()
		{
			$items = $this->getNodes();
			foreach ($items as $item) {
				$item->goodsInCategory = Good::where('rubric', $item->id)->count();
			}
			return view('admin.'.$this->route.'.index', [
				'items' => $items
			]);
		}

		public function withoutDescription()
		{
			$items = Rubric::where('text', '')->get();
			return view('admin.statistics.rubrics', [
				'items' => $items,
				'count' => count($items),
			]);
		}

		public function withoutPicture()
		{
			$items = Rubric::where('picture', '')->get();
			return view('admin.statistics.rubricspictures', [
				'items' => $items,
				'count' => count($items),
			]);
		}

		public function create()
		{
			return view('admin.'.$this->route.'.edit', [
					'action' => 'store',
					'item'   => new Rubric,
					'nodes'  => $this->getNodes(),
				]);
		}

		protected function getNodes() 
		{
			$data = Rubric::all()->toArray();
			$tree = new Tree($data);
			return $tree->getNodes();
		}

		public function store()
		{
			$item = new Rubric;
			$item->fill(Request::all());
			$item->save();
			return redirect()->route('admin.'.$this->route.'.edit', $item->id);
		}

		public function edit($id)
		{
			return view('admin.'.$this->route.'.edit', [
				'item'   => Rubric::find($id),
				'action' => 'update',
				'nodes'  => $this->getNodes(),
			]);
		}

		public function update($id)
		{
			$item = Rubric::find($id);
			$in_index = Request::get('in_index');
			$item->in_index = $in_index ? 1 : 0;
			$item->fill(Request::all());
			$item->save();
			//return redirect('/admin')->with('message', 'Profile updated!');
			return redirect()->back();
		}

		public function destroy($id)
		{
			Rubric::find($id)->delete();
		}

	}

?>