<?php
	namespace App\Http\Controllers\Admin;

	use Eloquent;
	use Illuninate\Database\Eloquent\Model;
	use Request;
	use App\Contact;

	class ContactsController extends BaseController 
	{

		public $route = 'contacts';

		public function index()
		{
			$items = Contact::all();
			return view('admin.'.$this->route.'.index', [
				'items' => $items
			]);
		}

		public function edit($id)
		{
			$item = Contact::find($id);
			return view('admin.'.$this->route.'.edit', [
				'item' => $item,
				'action' => 'update'
			]);
		}

		public function update($id)
		{
			$item = Contact::find($id);
			$item->fill(Request::all());
			$item->save();
			return redirect()->back();
		}

	}

?>