<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use DB;
use Cart;
use Session;

session_start();

class CheckoutController extends Controller
{
    public function login_check()
    {
    	return view('pages.login');
    }

    public function customer_registration(Request $request)
    {
    	$data = array();
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_email'] = $request->customer_email;
    	$data['password'] = md5($request->password);
    	$data['mobile_number'] = $request->mobile_number;

    	$customer_id = DB::table('tbl_customer')
    			->insertGetId($data);

		Session::put('customer_id', $customer_id);
		Session::put('customer_name', $request->customer_name);

		return Redirect::to('/checkout');

    }

    public function customer_login(Request $request)
    {
    	$customer_email = $request->customer_email;
    	$password = md5($request->password);

    	$customer = DB::table('tbl_customer')
    			->where('customer_email', $customer_email)
    			->where('password', $password)
    			->first();

//		echo "<pre>";
//    	print_r($customer);
//    	echo "</pre>";

		if($customer){
			Session::put('customer_id', $customer->customer_id);
			Session::put('customer_name', $customer->customer_name);
			return Redirect::to('/checkout');
		} else {
			Session::put('message', "Invalid Email or Password!");
			return Redirect::to('/login-check');
		}

    }

    public function customer_logout(Request $request)
    {	
    	Session::flush();
    	Session::get('customer_id').flush();
    	return Redirect::to('/');
    }

    public function checkout()
    {
    	return view('pages.checkout');
    }


    public function save_shipping(Request $request)
    {
    	$data = array();
    	$data['shipping_email'] = $request->shipping_email;
    	$data['shipping_first_name'] = $request->shipping_first_name;
    	$data['shipping_last_name'] = $request->shipping_last_name;
    	$data['shipping_address'] = $request->shipping_address;
    	$data['shipping_mobile'] = $request->shipping_mobile;
    	$data['shipping_city'] = $request->shipping_city;

    	// echo "<pre>";
    	// print_r($data);
    	// echo "</pre>";

    	$shipping_id = DB::table('tbl_shipping')
    			->insertGetId($data);

		Session::put('shipping_id', $shipping_id);

		return Redirect::to('/payment');
    }

    public function payment()
    {
    	$all_category = DB::table('tbl_category')
		    	->where('publication_status', 1)
		    	->get();

    	$manage_category = view('pages.payment')
    			->with('all_category', $all_category);

    	return view('welcome')
    	->with('pages.payment', $manage_category);

    	return view('pages.payment');
    }

    public function place_order(Request $request)
    {
    	$payment_method = $request->payment_method;

        $shipping_id = Session::get('shipping_id');
        $customer_id = Session::get('customer_id');

        $payment_data = array();
        $payment_data['payment_method'] = $request->payment_method;
        $payment_data['payment_status'] = 0;

        $payment_id = DB::table('tbl_payment')
                ->insertGetId($payment_data);

        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::getTotal();
        $order_data['order_status'] = 0;

        $order_id = DB::table('tbl_order')
                ->insertGetId($order_data);

        $contents = Cart::getContent();
        $order_d_data = array();

        // echo "<pre>";
        // print_r($contents);
        // echo "</pre>";
        // echo exit();

        foreach ($contents as $v_content) {
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->quantity;
            // $order_d_data['product_id'] = $v_content->product_id;
        }
        DB::table('tbl_order_detail')
                ->insert($order_d_data);

        // clearing the Cart



// WORKING HERE


        // foreach ($contents as $v_content) {
        //         Cart::remove($v_content->id);
        //     }

        if($payment_method == "bkash"){
            Session::put('message', "Successfully ordered by bKash");
            Session::put('method', 'bKash');
            return view('pages.bkash');
        }
        else if($payment_method == "payoneer"){
            Session::put('message', "Successfully ordered by Payoneer");
            return view('pages.payoneer');
        }
        else if($payment_method == "paypal"){
            Session::put('message', "Successfully ordered by PayPal");
            return view('pages.paypal');
        }
        else {
            echo "Not Selected!";
        }
    }
}
