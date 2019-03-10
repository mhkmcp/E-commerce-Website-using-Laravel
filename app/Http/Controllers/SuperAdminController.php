<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;

session_start();

class SuperAdminController extends Controller
{
    public function index()
    {
    	// $success = $this->adminAuth();
        // print_r($success);
    	return view('admin.dashboard');
    }

    public function logout()
    {
    	Session::flush();
    	Redirect::to('/backend');
    }

    public function adminAuth()
    {
    	$admin_id = Session::get('admin_id');
    	if ($admin_id) {
            return;
    	} else {
    		return Redirect::to('/backend')->send();
    	}

    }
}
