<?php

namespace App\Http\Controllers;
use Darryldecode\Cart\Facades\CartFacade as MyCart;
use Cart;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function add_to_cart(Request $request)
    {
    	$product_info = DB::table('tbl_products')
    				->where('product_id',  $request->product_id)
    				->first();
		
		// $data = array();
		// $data['quantity'] = $qty;
		// $data['id'] = $product_info->product_id;
		// $data['name'] = $product_info->product_name;
		// $data['price'] = $product_info->product_price;
		// $data['options']['image'] = $product_info->product_image;

		// Cart::add($data);
		Cart::add(array(
		    'id' => $request->product_id,
		    'name' => $product_info->product_name,
		    'price' => $product_info->product_price,
		    'quantity' => $request->qty,
		    'attributes' => array(
		    	'image' => $product_info->product_image,
			)
		));

		return Redirect::to('/show-cart');
    }

    public function show_cart()
    {
    	$all_category = DB::table('tbl_category')
		    	->where('publication_status', 1)
		    	->get();

    	$manage_category = view('pages.add_to_cart')
    			->with('all_category', $all_category);

    	return view('welcome')
    	->with('pages.add_to_cart', $manage_category);

    }

    public function delete_cart($id) 
    {
    	Cart::remove($id);
		// Cart::session($id)->clear();

		return Redirect::to('/show-cart');
    }

    public function increment_cart($id) 
    {
    	Cart::update($id, array(
    		'quantity'=> +1,
    	));

		return Redirect::to('/show-cart');
    }

    public function decrement_cart($id) 
    {
    	Cart::update($id, array(
    		'quantity'=> -1,
    	));

		return Redirect::to('/show-cart');
    }
}
