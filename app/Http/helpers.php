<?php

use App\ProductOrder;
use App\Product;
use App\Cart;
use App\Wishlist;

function totalorderproductquantity($order_id){
	return $totalquantity= ProductOrder::where('order_id','=', $order_id)->sum('product_quantity');
}

function numberOfProductCategories($category_id){
	return $totalproduct= Product::where('product_category',$category_id)->count();
}

function totalamountincart(){
	$total_amount=0;
	if(session()->has('customer_auth'))
        {
        	$session_id=session('customer_auth')->id;
        	$total_amount=DB::table('products')->join('carts','products.id','=','carts.product_id')->where('user_id',$session_id)->where('remaining_stock','>','0')->select(DB::raw('sum(new_price*quantity) as total'))->first();
		}
		echo $total_amount->total;
    }

function totalquantityincart(){
	if(session()->has('customer_auth'))
        {
        	$session_id=session('customer_auth')->id;
        	$total_quantity=DB::table('products')->join('carts','products.id','=','carts.product_id')->where('user_id',$session_id)->where('remaining_stock','>','0')->select(DB::raw('sum(quantity) as total'))->first();
		}
		echo $total_quantity->total;
    }

function totalwishlist(){
	if(session()->has('customer_auth'))
	{
		$session_id=session('customer_auth')->id;
		$total_wishlist=Wishlist::where('user_id',$session_id)->count();
		echo $total_wishlist;
	}
}


?>