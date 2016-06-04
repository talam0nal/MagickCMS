<?php
	namespace App\Http\Controllers\Admin;

	use Eloquent;
	use Illuninate\Database\Eloquent\Model;
	use Request;
	use App\Manager;
	use App\XML;
	use File;
	use DB;
	use Cache;

	class XMLController extends BaseController 
	{

		public function showForm()
		{
			return view('admin.xml.form', [
				'message' => Request::get('message'),
			]);
		}

		public function upload()
		{
			$file = Request::file('file');
			if (!$file) {
				return redirect('/admin/xml');
			}
			$path = public_path('/');
			$file->move($path, 'xml.xml');
			
			DB::table('rubrics')->delete();
			DB::table('goods')->delete();

			XML::fillRubrics();
			XML::parseGoods();

			File::delete('xml.xml');

			Cache::flush();

			return redirect('/admin/xml?message=success');
		}



	}

?>