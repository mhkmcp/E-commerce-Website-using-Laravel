<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;

session_start();

class SliderController extends Controller
{
  public function index()
    {
        // $this->adminAuth();
    	return view('admin.add_slider');
    }

    public function save_slider(Request $request)
    {
    	$data = array();
    	$data['publication_status']   = $request['publication_status'];

    	$slider_image  = $request->file('slider_image');

    	if($slider_image){
    		$image_name = str_random(20);
    		$ext = strtolower($slider_image->getClientOriginalExtension());
    		$slider_image_name = $image_name.'.'.$ext;
    		$upload_path = 'slider/';
    		$image_url = $upload_path.$slider_image_name;
    		$success = $slider_image->move($upload_path, $slider_image_name);

    		if($success){
    			$data['slider_image'] = $image_url;
    			DB::table('tbl_slider')->insert($data);
		    	Session::put('message', 'Sliderlider Added Successfully');
		    	return Redirect::to('/add-slider');
    		}
    	}
    	$data['slider_image'] = "";

    	DB::table('tbl_slider')->insert($data);
    	Session::put('message', 'Slider Added Successfully Without Image');
    	return Redirect::to('/add-slider');
    }

    public function all_slider()
    {
        // $this->adminAuth();
    	$all_slider = DB::table('tbl_slider')
    	 		->get();

    	$manage_slider = view('admin.all_slider')
    		->with('all_slider', $all_slider);

    	return view('admin_layout')
    		->with('admin.all_slider', $manage_slider);
    	return view('admin.all_slider');
    }

    public function inactive_slider($slider_id)
    {
    	DB::table('tbl_slider')
    		->where('slider_id', $slider_id)
    		->update(['publication_status' => 0]);
		Session::put('message', 'Slider Inactivated Successfully');
		return Redirect::to('/all-slider');
    }

    public function active_slider($slider_id)
    {
    	DB::table('tbl_slider')
    		->where('slider_id', $slider_id)
    		->update(['publication_status' => 1]);
		Session::put('message', 'Slider Activated Successfully');
		return Redirect::to('/all-slider');
    }


// Not YET Worked with edit_product
    public function edit_product($product_id)
    {
        // $this->adminAuth();
    	$product_info = DB::table('tbl_products')
    		->where('product_id', $product_id)
    		->first();

		$manage_product = view('admin.edit_product')
    		->with('product_info', $product_info);

    	return view('admin_layout')
    		->with('admin.edit_product', $manage_product);
    }
 
 	// Not YET Worked with update_product
    public function update_product(Request $request, $product_id)
    {
        // $this->adminAuth();
    	$data = array();
    	$data['category_name'] 		  = $request['category_name'];
    	$data['category_description'] = $request['category_description'];

    	DB::table('tbl_category')
    		->where('category_id', $category_id)
    		->update($data);
    	Session::put('message', 'Category Updated Successfully');

    	return Redirect::to('/all-category');
    }

    public function delete_slider($slider_id)
    {
        // $this->adminAuth();
    	DB::table('tbl_slider')
    		->where('slider_id', $slider_id)
    		->delete();
    	Session::put('message', 'Slider Deleted Successfully');

    	return Redirect::to('/all-slider');
    }
}