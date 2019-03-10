<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;

session_start();

class WishlistController extends Controller
{
    public function show()
    {
        $customer_id = Session::get('customer_id');
        $wishlists = DB::table('tbl_wishlist')
            ->join('tbl_products', 'tbl_wishlist.product_id','=','tbl_products.product_id')
            ->select('tbl_wishlist.*','tbl_products.product_image','tbl_products.product_price')
            ->where('customer_id', $customer_id)
            ->get();

//        $customer_id = Session::get('customer_id');
//        $wishlists = DB::table('tbl_wishlist')
//                ->where('customer_id', $customer_id)
//                ->get();

    	return view('pages.wishlist', compact('wishlists'));
    }

    public function add_to_wishlist(Request $request)
    {
        $customer_id = Session::get('customer_id');

        $data = array();
        $data['customer_id'] = $customer_id;
        $data['product_id'] = $request->product_id;

        $wishlist_id = DB::table('tbl_wishlist')
            ->insertGetId($data);

        return Redirect::to('/wishlist');

//        echo "<pre>";
//        print_r($customer_id);
//        print_r($request);
//        echo "</pre>";
    }

    public function delete_from_wishlist($product_id)
    {
        DB::table('tbl_wishlist')
            ->where('id', $product_id)
            ->delete();

        Session::put('message', 'One Item Deleted from Wishlist');

        return Redirect::to('/wishlist');
    }
}
