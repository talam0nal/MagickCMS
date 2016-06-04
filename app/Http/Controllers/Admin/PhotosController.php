<?php
	namespace App\Http\Controllers\Admin;

	use Eloquent;
	use Illuninate\Database\Eloquent\Model;
	use Request;
	use App\News;
	use App\Cover;
	use Image;
	use App\Photo;
	use Storage;


	class PhotosController extends BaseController 
	{

		public $route = 'photos';

		public function index($object_type, $object_id) 	
		{
			$items = Photo::where('object_type', $object_type)->where('object_id', $object_id)->get();
			return view('admin.'.$this->route.'.index', [
				'items'       => $items,
				'object_type' => $object_type,
				'object_id'   => $object_id,
			]);
		}



		public function store($object_type, $object_id)
		{
			$photos = Photo::upload($this->route);
			foreach ($photos as $key => $photo) {
				$item = new Photo;
				$item->object_type = $object_type;
				$item->image = $photo;
				$item->object_id   = $object_id;
				$item->save();
			}
			return redirect('/admin/photos/'.$object_type.'/'.$object_id);
		}



		protected function getCoverParams() 
		{		
			return Request::only('cover')['cover'] ? : [];
		}


		public function destroy($id)
		{
			$item = Photo::find($id)->first();
			$fileName = $item->image;
			unlink(public_path("/uploads/photos/".$fileName));
			unlink(public_path('/uploads/photos/small_'.$fileName));
			Photo::find($id)->delete();
		}

	}

?>