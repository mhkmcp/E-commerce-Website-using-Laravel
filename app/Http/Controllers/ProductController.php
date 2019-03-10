<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;

session_start();

class ProductController extends Controller
{
    public function index()
    {
        // $this->adminAuth();
    	return view('admin.add_product');
    }

    public function save_product(Request $request)
    {
    	$data = array();
    	
    	$data['product_name'] 		  = $request['product_name'];
    	$data['category_id'] 		  = $request['category_id'];
    	$data['manufacture_id'] 		  = $request['manufacture_id'];
    	$data['product_short_description']  = $request['product_short_description'];
    	$data['product_long_description']  = $request['product_long_description'];
    	$data['product_price']  = $request['product_price'];
    	$data['product_size']  = $request['product_size'];
    	$data['product_color']  = $request['product_color'];
    	$data['product_status']   = $request['product_status'];

    	$product_image  = $request->file('product_image');

    	if($product_image){
    		$image_name = str_random(20);
    		$ext = strtolower($product_image->getClientOriginalExtension());
    		$product_image_name = $image_name.'.'.$ext;
    		$upload_path = 'images/';
    		$image_url = $upload_path.$product_image_name;
    		$success = $product_image->move($upload_path, $product_image_name);

    		if($success){
    			$data['product_image'] = $image_url;
    			DB::table('tbl_products')->insert($data);
		    	Session::put('message', 'Product Added Successfully');
		    	return Redirect::to('/add-product');
    		}
    	}
    	$data['product_image'] = "";

    	DB::table('tbl_products')->insert($data);
    	Session::put('message', 'Product Added Successfully Without Image');
    	return Redirect::to('/add-product');
    }

    public function all_product()
    {
        // $this->adminAuth();
    	$all_product = DB::table('tbl_products')
    			->join('tbl_category', 'tbl_products.category_id','=','tbl_category.category_id')
    			->join('tbl_manufacture', 'tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
    			->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
    	 		->get();

    	$manage_product = view('admin.all_product')
    		->with('all_product', $all_product);

    	return view('admin_layout')
    		->with('admin.all_product', $manage_product);
    	return view('admin.all_product');
    }

    public function inactive_product($product_id)
    {
    	DB::table('tbl_products')
    		->where('product_id', $product_id)
    		->update(['product_status' => 0]);
		Session::put('message', 'Category Inactivated Successfully');
		return Redirect::to('/all-product');
    }

    public function active_product($product_id)
    {
    	DB::table('tbl_products')
    		->where('product_id', $product_id)
    		->update(['product_status' => 1]);
		Session::put('message', 'Category Activated Successfully');
		return Redirect::to('/all-product');
    }


// Not YET Worked with edit_product
    public function edit_product($product_id)
    {
        $product_info = DB::table('tbl_products')
            ->join('tbl_category', 'tbl_products.category_id','=','tbl_category.category_id')
            ->join('tbl_manufacture', 'tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
            ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
            ->where('product_id', $product_id)
            ->first();

        return view('admin.edit_product', compact('product_info'));
    }
 
 	// Not YET Worked with update_product
    public function update_product(Request $request, $product_id)
    {
        // $this->adminAuth();
        $data = array();

        $data['product_name'] 		  = $request['product_name'];
        $data['category_id'] 		  = $request['category_id'];
        $data['manufacture_id'] 		  = $request['manufacture_id'];
        $data['product_short_description']  = $request['product_short_description'];
        $data['product_long_description']  = $request['product_long_description'];
        $data['product_price']  = $request['product_price'];
        $data['product_size']  = $request['product_size'];
        $data['product_color']  = $request['product_color'];
//        $data['product_status']   = $request['product_status'];

        $product_image  = $request->file('product_image');

        $product_info = DB::table('tbl_products')
            ->where('product_id', $product_id)
            ->first();

        if($product_image){
            $image_name = str_random(20);
            $ext = strtolower($product_image->getClientOriginalExtension());
            $product_image_name = $image_name.'.'.$ext;
            $upload_path = 'images/';
            $image_url = $upload_path.$product_image_name;
            $success = $product_image->move($upload_path, $product_image_name);

            if($success){
                $data['product_image'] = $image_url;
                if(is_null($data['product_short_description'])) {
                    $data['product_short_description'] = $product_info->product_short_description;
                }
                if(is_null($data['product_long_description'])) {
                    $data['product_long_description'] = $product_info->product_long_description;
                }
                DB::table('tbl_products')
                    ->where('product_id', $product_id)
                    ->update($data);
                Session::put('message', 'Product Updated Successfully');
                return Redirect::to('/all-product');
            }
        }


        if(is_null($data['product_short_description'])) {
            $data['product_short_description'] = $product_info->product_short_description;
        }
        if(is_null($data['product_long_description'])) {
            $data['product_long_description'] = $product_info->product_long_description;
        }
        $data['product_image'] = $product_info->product_image;

        //print_r($data['product_image']);

        DB::table('tbl_products')
            ->where('product_id', $product_id)
            ->update($data);
        Session::put('message', 'Product Updated Successfully Without Image');
        return Redirect::to('/all-product');
    }

    public function delete_product($product_id)
    {
    	DB::table('tbl_products')
    		->where('product_id', $product_id)
    		->delete();

    	Session::put('message', 'Product Deleted Successfully');
        
    	return Redirect::to('/all-product');
    }










    // Order Manage
    public function manage_order()
    {
        $all_order = DB::table('tbl_order')
                ->join('tbl_customer', 'tbl_order.customer_id','=','tbl_customer.customer_id')
                ->select('tbl_order.*','tbl_customer.customer_name')
                ->get();

        $manage_order = view('admin.manage_order')
            ->with('all_order', $all_order);

        return view('admin_layout')
            ->with('admin.all_product', $manage_order);
        return view('admin.manage_order');   
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
