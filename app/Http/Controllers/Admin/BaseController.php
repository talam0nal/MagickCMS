<?php
	namespace App\Http\Controllers\Admin;
	use App\Http\Controllers\Controller;
	use App\News;
	use App\Http\Requests;
	use Illuminate\Http\Request;
	use Session;
	use Auth;

	class BaseController extends Controller {

	    public function __construct()
	    {
	        if (!Auth::guard('users')->check()) {
				header("Location: http://".$_SERVER['HTTP_HOST']."/admin/login");
				exit();
	        }	    	
	    }


	}

?>