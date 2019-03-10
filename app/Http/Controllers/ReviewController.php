<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Facades\Auth;
use DB;
use Cart;
use Session;

session_start();

class ReviewController extends Controller
{
    public function review_product($product_id) {
    	// echo $request->product_id;
    	Session::put('product_id', $product_id);
    	
    	$customer_id = Session::get('customer_id');
    	
    	return view('pages.review_form', compact('product_id',$product_id));
    }

    public function save_review(Request $request) {
    	
    	$data = array();

    	$customer_id = Session::get('customer_id');
    	$product_id = Session::get('product_id');

    	// echo "c_id: ".$customer_id;
    	// echo "<br>p_id: ".$product_id;

    	$data['product_id']  = $product_id;
    	$data['customer_id'] = $customer_id;
    	$data['review'] 	 = $request->review;
    	$data['rating'] 	 = $request->rating;

    	// print_r($data);

    	$review_id = DB::table('tbl_review')
    			->insertGetId($data);
		Session::put('review_id', $review_id);
		// Session::put('cmessage', 'Your Review is Added Successfully!');
		$method = Session::get('method');
		// echo "method: ".$method;
		if($method == 'bKash')
    		return view('pages.bkash');
    }
}
