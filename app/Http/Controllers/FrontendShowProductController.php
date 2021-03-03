<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use App\Category;
use App\Coupon;
use App\Brand;
use App\Cart;
use App\Order;
use App\Wishlist;
use App\ProductOrder;
use App\Useraddress;
use App\Websiteui;
use App\Homeslider;
use App\EcommerceSetting;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\helpers;

class FrontendShowProductController extends Controller
{
    public function allproduct()
    {
        $item_per_page=$this->pagination();
        $product =DB::table('categories')
            ->join('products', 'categories.id', '=', 'products.product_category')
            ->where('category_status','1')->where('product_status','1')->paginate($item_per_page);
        $category = DB::table('categories')
            ->join('products', 'categories.id', '=', 'products.product_category')
            ->where('category_status','1')->select(DB::raw('distinct(product_category) as distincct'),'categoryname','categories.slug')->get();
        return view('frontend.pages.product', compact('product', 'category'));
    }

    protected function allowMaxQuantity(){
        $maximum_quantity=EcommerceSetting::first();
        return $maximum_quantity->maximum_quantity;
    }

    public function allconditionproduct($condition)
    {
        $item_per_page=$this->pagination();
        if($condition=='asc' || $condition == 'desc')
            {
             $product =DB::table('categories')->join('products', 'categories.id', '=', 'products.product_category')->where('category_status','1')->where('product_status','1')->orderBy('product_name', $condition)->paginate($item_per_page);
            }
        else
            if($condition=='low' || $condition=='high')
            {
                
                $new_condition=$condition=='low'?'asc':'desc';
                $product =DB::table('categories')->join('products', 'categories.id', '=', 'products.product_category')->where('category_status','1')->where('product_status','1')->orderBy('new_price', $new_condition)->paginate($item_per_page);
            }
            else
            {
                return redirect()->route('all-product');

            }
        $category = DB::table('categories')
            ->join('products', 'categories.id', '=', 'products.product_category')
            ->where('category_status','1')->select(DB::raw('distinct(product_category) as distincct'),'categoryname','categories.slug')->get();
        if(empty($category))
        {
            return redirect()->route('all-products');
        }
        
        return view('frontend.pages.product', compact('product', 'category'));
    }

    public function homepage()
    {
        $present_date=date('Y-m-d');
        $product = Product::all();
        $homeslider=Homeslider::where('status',1)->get();
    
        $hot_deal_products=Product::where('hot_deals','1')->get();
        $count_hot_deal_products=Product::where('hot_deals','1')->where('hot_deals_expiry_date','>=',$present_date)->count();
        $premium_product=Websiteui::where('id','1')->first();
        $array_premium_images=explode(',',$premium_product->websiteui_images);
        $array_premium_link=explode(',',$premium_product->websiteui_link);
        $popular_categories_bg_image=Websiteui::where('id','2')->first();
        $offer_banners=Websiteui::where('id','3')->first();
        $array_offer_banners_images=explode(',',$offer_banners->websiteui_images);
        $array_offer_banners_link=explode(',',$offer_banners->websiteui_link);

        $our_product_category= DB::table('categories')
            ->join('products', 'categories.id', '=', 'products.product_category')
            ->where('category_status', '1')->where('product_status', '1')->select('product_category',DB::raw('count(products.id) as total'))->groupBy('product_category')->limit(3)->get();
        $new_arrival_product = DB::table('categories')
            ->join('products', 'categories.id', '=', 'products.product_category')
            ->where('category_status', '1')->where('product_status', '1')->limit(6)->get();
        $best_sellers= Product::limit(6)->get();
        $best_sellers = DB::table('categories')
            ->join('products', 'categories.id', '=', 'products.product_category')
            ->where('category_status', '1')->where('product_status', '1')->limit(6)->get();
        $feature_product = DB::table('categories')
            ->join('products', 'categories.id', '=', 'products.product_category')
            ->where('category_status', '1')->where('product_status', '1')->inRandomOrder()->limit(10)->get();
        $brand = Brand::all();
        return view('frontend.pages.home', compact('product', 'our_product_category', 'brand','new_arrival_product','feature_product','array_offer_banners_images','array_offer_banners_link','popular_categories_bg_image','best_sellers','homeslider','array_premium_link','array_premium_images','hot_deal_products','count_hot_deal_products'));
    }

    public function categoryproduct($slug){

        $get_category_id=Category::where('slug','=', $slug)->first();
        if(empty($get_category_id))
        {
            return redirect()->route('all-product');
        }
        $item_per_page=$this->pagination();
        $category_id=$get_category_id->id;
        $product =DB::table('categories')->join('products', 'categories.id', '=', 'products.product_category')->where('category_status','1')->where('product_status','1')->where('product_category','=', $category_id)->paginate($item_per_page);
        $category = DB::table('categories')
            ->join('products', 'categories.id', '=', 'products.product_category')
            ->where('category_status','1')->select(DB::raw('distinct(product_category) as distincct'),'categoryname','categories.slug')->get();
        return view('frontend.pages.category', compact('category','product','get_category_id'));
    }

    public function navigationWishlist()
    {
        if(session()->has('customer_auth')){
            $session_id=session('customer_auth')->id;
            $count_cart=Cart::where('user_id','=', $session_id)->count();
            $cart_product=Cart::where('user_id','=', $session_id)->get();
            return view('frontend.pages.home', compact('count_cart', 'cart_product'));
        }
        else
        {
            //Cookies
        }
    }

    public function checkout()
    {
        $total_cart_amount=0;
        $total_quantity=0;
        if(session()->has('customer_auth')){
            $session_id=session('customer_auth')->id;
            $get_total_amount= DB::table('carts')
            ->join('users', 'carts.user_id', '=', 'users.id')
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->select('products.new_price as amount','carts.quantity as quantity')->where('carts.user_id', '=', $session_id)->where('remaining_stock','>','0')->get();
            foreach($get_total_amount as $get_amount)
            {
                $total_cart_amount+=$get_amount->amount*$get_amount->quantity;
                $total_quantity+=$get_amount->quantity;
            }
            $all_user_address=Useraddress::where('user_id', '=', $session_id)->get();
            $total_user_address=Useraddress::where('user_id', '=', $session_id)->count();
        return view('frontend.pages.checkout', compact('total_cart_amount','total_quantity','all_user_address','total_user_address'));
        }
        else
        {
            return redirect('/login')->with('success','Please login or Sign up to checkout.');
        }
    }

    public function checkoutpost(Request $request)
    {
        $request->validate([
            'hidden_shipping_address' => 'required|integer',
            'hidden_billing_address' => 'nullable|integer',
            'total_amount' => 'required|integer',
            'coupon_code' => 'nullable',
        ]);
        if(!empty($request->coupon_code))
        {
            $coupon=Coupon::where('coupon_code',$request->coupon_code)->first();
        }
        $max_quantity=$this->allowMaxQuantity();
        if(session()->has('customer_auth')){
            $session_id=session('customer_auth')->id;
            $cart_product=DB::table('products')->join('carts','products.id','=','carts.product_id')->where('user_id',$session_id)->get();
            foreach($cart_product as $check_cart_product)
            {
                if($check_cart_product->quantity > $max_quantity)
                {
                    return redirect()->route('cart')->with('error','You already have the maximum quantity available for this product. Please remove from the cart');
                }

                if($check_cart_product->quantity > $check_cart_product->remaining_stock)
                {
                    return redirect()->route('cart')->with('error','Your product has been out of stock. Please remove from the cart');
                }
            }
            $customer_detail=User::where('id','=', $session_id)->first();
            //Payment Mode : 1 for Cash on Delivery
            //ES-202012001
            $invoice_number=Order::orderBy('id', 'desc')->first();
            if(empty($invoice_number))
            {
                $generate_invoice_number='1';
            }
            else
            {
                $generate_invoice_number=$invoice_number->invoice_number+1;
            }
            $get_shipping_address=Useraddress::where('id',$request->hidden_shipping_address)->first();

            if($request->hidden_billing_address==null)
            {
                $request->hidden_billing_address=$get_shipping_address->id;
            }
            $get_billing_address=Useraddress::where('id',$request->hidden_billing_address)->first();
            //Insert Order Detail in order Table
            $created_order= Order::create([
            'invoice_number' => $generate_invoice_number,
            'customer_id' => $session_id,
            'customer_name' => $get_shipping_address->user_name,
            'customer_phone' => $get_shipping_address->phone,
            'payment_mode' => '1',
            'discount' => '0',
            'tax' => '0',
            'total_invoice_amount' => $request->total_amount,
            'shipping_address_full_name' => $get_shipping_address->user_name,
            'shipping_address' => $get_shipping_address->address,
            'shipping_address_state' => $get_shipping_address->state,
            'shipping_address_pincode' => $get_shipping_address->pincode,
            'shipping_address_phone' => $get_shipping_address->phone,
            'billing_address_full_name' => $get_billing_address->user_name,
            'billing_address' => $get_billing_address->address,
            'billing_address_state' => $get_billing_address->state,
            'billing_address_pincode' =>$get_billing_address->pincode,
            'billing_address_phone' => $get_billing_address->phone,
            'order_description' => $request->shipping_comment ?? '',
            'coupon_id' => $coupon->id ?? null,
            'coupon_code' => $coupon->coupon_code ?? null,
            'discount_percentage' =>$coupon->discount_percentage ?? null,
            'delivery_charges' =>$request->delivery_charges ?? '0',
            ]);
            $insertedId = $created_order->id;

            foreach($cart_product as $cart_products)
            {
                $product_id=$cart_products->product_id;
                $product_quantity=$cart_products->quantity;
                $product_info=Product::where('id','=', $product_id)->first();
                $remaining_stock=$product_info->remaining_stock-$product_quantity;
                $final_amount=$product_quantity*$product_info->new_price;
                
                //Insert Product Detail in Product order 
                $product_order= new ProductOrder();
                $product_order->product_id=$product_id;
                $product_order->product_name=$product_info->product_name;
                $product_order->product_quantity=$product_quantity;
                $product_order->final_price=$final_amount;
                $product_order->feature_image=$product_info->feature_image;
                $product_order->order_id=$insertedId;
                $product_order->save();

                //Updating Remaining Stock in Product table 
                $product_info->remaining_stock=$remaining_stock;
                $product_info->save();
                
                //Cart Delete Item
                Cart::where('id', $cart_products->id)->delete();
            }
            //Return To Thank You page
        }
        return redirect()->route('my-account')->with('success','Your Product has been order successfully');
    }

    public function addtocartpage(Request $request)
    {
        $allow_maximum_stock=$this->allowMaxQuantity();
        $cookie_product_quantity=array();
        $cookie_product_id_array=array();
        $max_quantity=0;
        $total_out_of_stock=0;
        if(session()->has('customer_auth')){
            $session_id=session('customer_auth')->id;
            $display_cart = DB::table('carts')
            ->join('users', 'carts.user_id', '=', 'users.id')
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->select('users.*', 'products.*','carts.*','carts.id as cartid')->where('carts.user_id', '=', $session_id)->get();
            foreach($display_cart as $cart_item)
            {
                if($cart_item->quantity>$allow_maximum_stock)
                {
                    $max_quantity+=1;
                }
                if($cart_item->quantity>$cart_item->remaining_stock)
                {
                    $total_out_of_stock+=1;
                }
            }
        }
        else
        {
            //Cookies
            $cookie_value = $request->cookie('eshop');
            if(!empty($cookie_value))
            {
                $product_id='';
                $cookie_value_in_array=json_decode($cookie_value, TRUE);
                $cookie_product_id = implode(',', array_keys($cookie_value_in_array));
                $cookie_product_id_array = array_keys($cookie_value_in_array);
                foreach($cookie_product_id_array as $array)
                {

                    $product_id.=$array.',';
                }
                $only_product_id= substr($product_id, 0, -1);
                $cookie_product_quantity = array_values($cookie_value_in_array);
                
                $ids=explode(",", $cookie_product_id);

                $display_cart=Product::select('new_price','feature_image','product_name','slug','remaining_stock')->whereIn('id', $ids)->orderBy(DB::raw('FIELD(id,'. $only_product_id .')'))->get();
            }
            else
            {
                $display_cart=array();
            }
        }
        return view('frontend.pages.cart', compact('display_cart','cookie_product_quantity','cookie_product_id_array','max_quantity','allow_maximum_stock','total_out_of_stock'));
    }
    public function showmodalincart(Request $request){
        echo totalquantityincart();
        /*if(session()->has('customer_auth')){
            $session_id=session('customer_auth')->id;
            $total_quantity=Cart::where('user_id',$session_id)->sum('quantity');
            $cart_product=Cart::where('user_id',$session_id)->->orderBy('id', 'DESC')->first();
            
        }
        else
        {
            //Cookies
            $cookie_value = $request->cookie('eshop');
            if(!empty($cookie_value))
            {
            $cookie_value_in_array=json_decode($cookie_value, TRUE);
            $cookie_product_id = implode(',', array_keys($cookie_value_in_array));
            $cookie_product_id_array = array_keys($cookie_value_in_array);
            $cookie_product_quantity = array_values($cookie_value_in_array);
            $display_cart=Product::select('new_price','feature_image','product_name','slug')->whereIn('id', explode(',', $cookie_product_id))->get();
        }*/
    }

    public function addtocartproduct(Request $request)
    {
        $product_id=$request->product_id;
        $allow_max_quantity=$this->allowMaxQuantity();
        if(session()->has('customer_auth'))
        {
            $session_id=session('customer_auth')->id;
            $count_cart=Cart::where('user_id','=', $session_id)->where('product_id','=', $product_id)->count();
            
            if($count_cart=='0')
            { 
                $quantity='1';
                Cart::create(
                [
                    'user_id' => $session_id,
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                ]);
                echo "1";
            }
            else
            {
                $get_quantity=Cart::where('user_id','=', $session_id)->where('product_id','=', $product_id)->first();
                if($get_quantity->quantity>=$allow_max_quantity)
                {
                    //already have the maximum quantity available for this product
                    echo "2";
                }
                else
                {
                    $quantity=$get_quantity->quantity+1;
                    $get_quantity->quantity=$quantity;
                    $get_quantity->save();
                    echo "1";
                }
            }
        }
        else
        {
            //Cookies
            $cookie_array=array();
            $minutes = 604800;
            $response = new Response();
            if($request->cookie('eshop'))
                { 
                    $cookie_array[$product_id]='1';
                    $cookie_value = $request->cookie('eshop');
                    $json_array=json_decode($cookie_value, TRUE);
                    if (array_key_exists($product_id,$json_array))
                          {
                            if($json_array[$product_id]>=$allow_max_quantity)
                            {
                                //already have the maximum quantity available for this product
                                echo "2";
                            }
                            else
                            {
                                $json_array[$product_id]=$json_array[$product_id]+1;
                                $cookie_value=json_encode($json_array);
                                echo "1";
                            }
                          }
                        else
                          {
                            $a=$json_array+ $cookie_array;
                            $cookie_value=json_encode($a);
                            echo "1";
                          }
                    $response->withCookie(cookie('eshop', $cookie_value , $minutes));
                }
                else
                { 
                    $cookie_array[$product_id]='1';
                    $cookie_value=json_encode($cookie_array);
                    $response->withCookie(cookie('eshop', $cookie_value, $minutes));
                    echo "1";
                }
            return $response;
        }
    }

    public function updatequantity(Request $request)
    {
        $cart_id=$request->cart_id;
        $update_qty=$request->update_qty;
       if(session()->has('customer_auth'))
        {
            // Session
            $session_id=session('customer_auth')->id;
            $update_cart=Cart::where('id','=', $cart_id)->first();
            $product_id=$update_cart->product_id;
            $get_product_price=Product::where('id','=', $product_id)->first();
            $product_cart_new_price=$get_product_price->new_price;
            $update_cart->quantity=$update_qty;
            $update_cart->save();
            return $update_product_cart_price=$update_qty*$product_cart_new_price;
        }
        else
        {
            //Cookies
            $cookie_array=array();
            $minutes = 604800;// 60*60*24*7 = 604800
            $response = new Response();
            $product_id=$request->cart_id;
            $update_qty=$request->update_qty;
            $cookie_value = $request->cookie('eshop');
            $json_array=json_decode($cookie_value, TRUE);
            if (array_key_exists($product_id,$json_array))
                {
                    $get_product_price=Product::where('id', $product_id)->select('new_price')->first();
                    $update_price=$get_product_price->new_price*$update_qty;
                    $json_array[$product_id]=$update_qty;
                    $new_cookie_value=json_encode($json_array);
                }
                echo $update_price;
            return $response->withCookie(cookie('eshop', $new_cookie_value , $minutes));
        }
    }

    public function productdetail($slug)
    {
        $product_detail = Product::where('slug','=', $slug)->where('product_status','1')->first();
        if(!empty($product_detail))
        {
            $other_product = Product::whereNotIn('slug', [$slug])->limit(6)->get();
            return view('frontend.pages.product_detail', compact('product_detail','other_product'));
        }
        else
        {
         return redirect()->route('home');  
        }
    }

    public function ajaxwishlist(Request $request)
    {
        $product_id=$request->wishlist_product_id;
        if(session()->has('customer_auth'))
        {
            // Session
            $session_id=session('customer_auth')->id;
            $check_product_available=Wishlist::where('product_id','=', $product_id)->where('user_id','=', $session_id)->count();
            if($check_product_available=='0')
            {
                Wishlist::create(
                    [
                        'product_id' => $product_id,
                        'user_id' => $session_id,
                    ]);
                echo "1";
            }
            else
            {
                //message for wishlist is already exists
                echo "2";
            }
        }
        else
        {
            //For Cookies No Code 
            echo "for Cookies no code";
        }

    }

    public function wishlistpage()
    {
        if(session()->has('customer_auth'))
        {
            // Session
            $session_id=session('customer_auth')->id;
            $get_wishlist_product=DB::table('wishlists')
            ->join('products', 'wishlists.product_id', '=', 'products.id')
            ->join('users', 'wishlists.user_id', '=', 'users.id')
            ->select('*','wishlists.id as id')->where('wishlists.user_id', '=', $session_id)->get();
            
            return view('frontend.pages.wishlist', compact('get_wishlist_product'));
        }
    }

    public function wishlistTrashButton(Request $request)
    {
        if(session()->has('customer_auth'))
        {
            $wishlist_detail=Wishlist::find($request->wishlist_id);
            $wishlist_detail->delete();
            echo "1";
        }
    }
    public function movetobagbutton(Request $request)
    {
       $allow_max_quantity=$this->allowMaxQuantity();
       if(session()->has('customer_auth'))
        {
            $session_id=session('customer_auth')->id;
            $wishlist_detail=Wishlist::find($request->cart_id);
            $product_id=$wishlist_detail->product_id;
            $count_cart=Cart::where('user_id','=', $session_id)->where('product_id','=', $product_id)->count();
            if($count_cart=='0')
            { 
                $quantity='1';
                Cart::create(
                [
                    'user_id' => $session_id,
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                ]);
                $wishlist_detail->delete();
                echo "1";
            }
            else
            {
                $get_quantity=Cart::where('user_id','=', $session_id)->where('product_id','=', $product_id)->first();
                if($allow_max_quantity > $get_quantity->quantity)
                {
                    $quantity=$get_quantity->quantity+1;
                    $get_quantity->quantity=$quantity;
                    $get_quantity->save();
                    $wishlist_detail->delete();
                    echo "1";
                }
                else
                {
                    echo "2";
                }
            }
        }
    }

    public function removecart(Request $request){
        if(session()->has('customer_auth'))
        {
            $session_id=session('customer_auth')->id;
            $cart_detail=Cart::where('id',$request->cart_id)->first();
            $cart_detail->delete();
            echo "1";
        }
        else
        {
            //Cookies
            $cookie_array=array();
            $minutes = 604800;
            $response = new Response();
            $product_id=$request->cart_id;
            $cookie_value = $request->cookie('eshop');
            $json_array=json_decode($cookie_value, TRUE);
            unset($json_array[$product_id]);
            if(empty($json_array)) 
            {
                $minutes = -604800;
            }
            $new_cookie_value=json_encode($json_array);
            return $response->withCookie(cookie('eshop', $new_cookie_value , $minutes));
        }
    }

    public function offcanvascart(Request $request){
        $total_amount=0;
        $output= '<ul class="minicart-product-list">';
        if(session()->has('customer_auth'))
        {
            $session_id=session('customer_auth')->id;
            $cart_detail=Cart::where('user_id',$session_id)->get();
            foreach($cart_detail as $cart_details)
            {
                $product_detail=Product::select('new_price','feature_image','product_name','slug','remaining_stock')->where('id',$cart_details->product_id)->first();
                $output.= '<li><a href="'.url('product-detail/'.$product_detail->slug.'').'" class="image"><img src="'.url($product_detail->feature_image).'" alt="Cart product Image"></a><div class="content"><a href="'.url('product-detail/'.$product_detail->slug.'').'" class="title">'.$product_detail->product_name.'</a>';
                if($product_detail->remaining_stock>0)
                {
                    $output.='<span class="quantity-price">'.$cart_details->quantity.' x <span class="amount">'.$product_detail->new_price.'</span></span>';
                    $total_amount+=$product_detail->new_price*$cart_details->quantity;
                }
                else
                {
                    $output.='<span class="float-right mr-4" style="color:red;">Out Of Stock</span>';
                }
                $output.='<a href="#" class="remove">×</a></div></li>';
            }
            $output.='</ul><div class="sub-total d-flex flex-wrap justify-content-between"><strong>Subtotal :</strong><span class="amount">INR '.$total_amount.'</span></div>';
            echo $output;
        }
        else
        {
            $cookie_value = $request->cookie('eshop');
            $cookie_value_in_array=json_decode($cookie_value, TRUE);
            foreach($cookie_value_in_array as $product_id => $quantity)
            {
                $product_detail=Product::select('new_price','feature_image','product_name','slug','remaining_stock')->where('id',$product_id)->first();
                $output.= '<li><a href="'.url('product-detail/'.$product_detail->slug).'" class="image"><img src="'.url($product_detail->feature_image).'" alt="Cart product Image"></a><div class="content"><a href="'.url('product-detail/'.$product_detail->slug.'').'" class="title">'.$product_detail->product_name.'</a>';
                if($product_detail->remaining_stock>0)
                {
                    $output.='<span class="quantity-price">'.$quantity.' x <span class="amount">'.$product_detail->new_price.'</span></span>';
                    $total_amount+=$product_detail->new_price*$quantity;
                }
                else
                {
                    $output.='<span class="float-right mr-4" style="color:red;">Out Of Stock</span>';   
                }
                $output.='<a href="#" class="remove">×</a></div></li>';
                
            }
            $output.='</ul><div class="sub-total d-flex flex-wrap justify-content-between"><strong>Subtotal :</strong><span class="amount">INR '.$total_amount.'</span></div>';
            echo $output;
        }
    }

    public function offcanvaswishlist(){
        $output= '<ul class="minicart-product-list">';
        if(session()->has('customer_auth'))
        {
            $session_id=session('customer_auth')->id;
            $wishlist_detail=Wishlist::where('user_id',$session_id)->get();
            foreach($wishlist_detail as $wishlist_details)
            {

                $product_detail=Product::select('new_price','feature_image','product_name','slug','remaining_stock')->where('id',$wishlist_details->product_id)->first();
                $output.='<li><a href="'.url('product-detail/'.$product_detail->slug.'').'" class="image"><img src="'.url($product_detail->feature_image).'" alt="Cart product Image"></a>
                <div class="content">
                    <a href="'.url('product-detail/'.$product_detail->slug).'" class="title">'.$product_detail->product_name.'</a>';
                if($product_detail->remaining_stock>0)
                {   
                    $output.='<span class="quantity-price">1 x <span class="amount">'.$product_detail->new_price.'</span></span>';
                }
                else
                {
                    $output.='<span class="float-right mr-4" style="color:red;">Out Of Stock</span>';
                }
                $output.='<a class="remove" data-removeid="'.$wishlist_details->id .'">×</a></div></li>';
            }
        }
        echo $output;
    }

    public function gettotalquantity(Request $request){
        if(session()->has('customer_auth'))
        {
            echo totalquantityincart();
        }
        else
        {
            $cookie_value = $request->cookie('eshop');
            $cookie_value_in_array=json_decode($cookie_value, TRUE);
            echo array_sum($cookie_value_in_array);
        }
    }

    public function gettotalwishlist(){
        echo totalwishlist();
    }

    public function gettotalamount(Request $request){
        if(session()->has('customer_auth'))
        {
            echo totalamountincart();
        }
        else
        {
            $total_amount=0;
            $cookie_value = $request->cookie('eshop');
            $cookie_value_in_array=json_decode($cookie_value, TRUE);
            foreach($cookie_value_in_array as $product_id => $quantity)
            {
                $product_detail=Product::select('new_price')->where('id',$product_id)->where('remaining_stock','<>','0')->first();
                if(!empty($product_detail))
                {
                    $total_amount+=$product_detail->new_price*$quantity;
                }
            }
            echo $total_amount;
        }
    }

    public function search(Request $request)
    {  $search=$request->search;
        $item_per_page=$this->pagination();
        $category = Category::where('category_status','=', '1')->get();

        $product = DB::table('categories')
            ->join('products', 'categories.id', '=', 'products.product_category')
            ->where('category_status','1')->where('product_status','1')->where('product_name','like','%' . $search . '%')->orWhere('product_description','like','%' . $search . '%')->orWhere('products.metadescription','like','%' . $search . '%')->paginate($item_per_page);
        
        if(count($product)==0)
        {
             return redirect()->route('all-product');
        }
        else
        {
            return view('frontend.pages.product', compact('product', 'category'));
        }
    }

    public function checkcoupon(Request $request){
        if(session()->has('customer_auth'))
        {
            $coupon_exist= $this->couponexist($request->coupon_code);
            if($coupon_exist)
            {
                $session_id=session('customer_auth')->id;
                $count_coupon_used=Order::where('coupon_id',$coupon_exist->id)->count();
                if($count_coupon_used<$coupon_exist->use_per_customer)
                {
                    return response()->json($coupon_exist);
                }
                else
                {
                    echo "1";
                }
            }
            else
            {
                echo "2";
            }
        }
        else
        {
            echo "3";
        }
    }

    protected function couponexist($coupon_code){
        $present_date=date('Y-m-d');
        $coupon=Coupon::where('coupon_code',$coupon_code)->whereRaw('"'.$present_date.'" between `starting_date` and `ending_date`')->where('coupon_status','1')->first();
        if($coupon)
        {
            return $coupon;
        }
        else
        {
            return false;
        }
    }

    protected function pagination(){
        $ecommerce_settings=EcommerceSetting::first();
        $item_per_page=$ecommerce_settings->pagination;
        return $item_per_page;
    }
}
