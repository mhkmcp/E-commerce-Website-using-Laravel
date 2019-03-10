<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;

session_start();

class HomeController extends Controller
{
    public function index()
    {
    	$all_published_product = DB::table('tbl_products')
    			->join('tbl_category', 'tbl_products.category_id','=','tbl_category.category_id')
    			->join('tbl_manufacture', 'tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
    			->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
    			->where('product_status', 1)
    			->limit(9)
    	 		->get();

 		$manage_published_product = view('pages.home_content')
    		->with('all_published_product', $all_published_product);

    	return view('welcome')
    		->with('pages.home_content', $manage_published_product);
    }

    public function show_product_by_category($category_id)
    {
        // echo $category_id;
        $product_by_category = DB::table('tbl_products')
                ->join('tbl_category', 'tbl_products.category_id','=','tbl_category.category_id')
                ->join('tbl_manufacture', 'tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
                ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                ->where('product_status', 1)
                ->where('tbl_category.category_id', $category_id)
                ->limit(18)
                ->get();

        $manage_product_by_category = view('pages.product_by_category')
            ->with('product_by_category', $product_by_category);

        return view('welcome')
            ->with('pages.product_by_category', $manage_product_by_category);
    }

    public function show_product_by_manufacture($manufacture_id)
    {
        $product_by_manufacture = DB::table('tbl_products')
                ->join('tbl_category', 'tbl_products.category_id','=','tbl_category.category_id')
                ->join('tbl_manufacture', 'tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
                ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                ->where('tbl_manufacture.manufacture_id', $manufacture_id)
                ->where('product_status', 1)
                ->limit(18)
                ->get();

        $manage_product_by_category = view('pages.product_by_manufacture')
            ->with('product_by_manufacture', $product_by_manufacture);

        return view('welcome')
            ->with('pages.product_by_manufacture', $manage_product_by_category);
    }

    public function view_product_detail($product_id)
    {
        $product_detail = DB::table('tbl_products')
                ->join('tbl_category', 'tbl_products.category_id','=','tbl_category.category_id')
                ->join('tbl_manufacture', 'tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
                ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                ->where('tbl_products.product_id', $product_id)
                ->where('product_status', 1)
                ->limit(18)
                ->first();

        Session::put('product_id', $product_id);

        $manage_product_detail = view('pages.product_detail')
            ->with('product_detail', $product_detail);

        return view('welcome')
            ->with('pages.product_detail', $manage_product_detail);

    }

    public function profile($customer_id)
    {
//        $customer_id = Session::get('customer_id');
        $customer = DB::table('tbl_customer')
            ->where('customer_id', $customer_id)
            ->first();

        return view('pages.customer_profile', compact('customer'));
    }


}
