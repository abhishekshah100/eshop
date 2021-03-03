<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Cart;
use Session;
use Cookie;
use App\Useraddress;
use App\EcommerceSetting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserPanelController extends Controller
{

	public function index(Request $request)
    {
    	$session_id = session('customer_auth');
        $user = User::findOrFail($session_id->id);
        
        $minutes = -1000;
        $response = new Response();
        $cookie_value = $request->cookie('eshop');
        if(!empty($cookie_value))
            {
                $cookie_value_in_array=json_decode($cookie_value, TRUE);
                $count_cookie_value=count($cookie_value_in_array);
                $cookie_product_id_array = array_keys($cookie_value_in_array);
                $cookie_product_quantity = array_values($cookie_value_in_array);
                for($i=0; $i<$count_cookie_value; $i++)
                {
                     $get_cart=Cart::where('user_id',$user->id)->where('product_id',$cookie_product_id_array[$i])->first();
                     if(empty($get_cart))
                     {
                        Cart::create(
                        [
                            'user_id' => $user->id,
                            'product_id' => $cookie_product_id_array[$i],
                            'quantity' => $cookie_product_quantity[$i],
                        ]);
                    }
                    else
                    {
                        $max_quantity=$this->allowMaxQuantity();
                        $total_quantity=$get_cart->quantity+$cookie_product_quantity[$i];
                        if($total_quantity>$max_quantity)
                        {
                            $get_cart->quantity=$max_quantity;
                            $get_cart->save();
                        }
                        else
                        {
                            $get_cart->quantity=$total_quantity;
                            $get_cart->save();
                        }
                    }
                }
                $cookie = Cookie::forget('eshop');
                return redirect()->route('my-account')->withCookie($cookie);
            }




        $all_user_address=Useraddress::where('user_id',$session_id->id)->get();
        $get_all_order = Order::where('customer_id','=', $session_id->id)->orderBy('id', 'desc')->get();
        return view('frontend.pages.my_account', compact('user','get_all_order','all_user_address'));
    }


    public function account_detail()
    {
    	$session_id = session('customer_auth');
    	$user = User::findOrFail($session_id->idd);
        
        return Redirect::back()->with('message','Account Details has been Successful !');
    }

    protected function allowMaxQuantity(){
        $maximum_quantity=EcommerceSetting::first();
        return $maximum_quantity->maximum_quantity;
    }

    public function saveaccountdetail(Request $request)
    {
        $session_id = session('customer_auth');
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'password' => 'required',
            'new_password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:new_password',
        ]);
        $user=User::where('email',$session_id->email)->where('password',$request->password)->first();
        if($user)
        {
            $user->password=$request['new_password'];
            $user->first_name=$request['first_name'];
            $user->last_name=$request['last_name'];
            $user->save();
            return redirect()->route('my-account')->with('success','Congratulations! You\'ve successfully changed your password');
        }
        else
        {
            return back()->with('error','The credentials do not match on our records');
        }
    }
}
