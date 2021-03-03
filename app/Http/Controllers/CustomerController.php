<?php
namespace App\Http\Controllers;
use App\User;
use App\Cart;
use App\Useraddress;
use App\Newsletter;
use App\EcommerceSetting;
use Session;
use Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\NewsletterRequest;
use App\Mail\RegisterMail;
use App\Mail\ForgotPasswordMail;
use Laravel\Socialite\Facades\Socialite;

class CustomerController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8',
            'birthdate' =>'required',
            'password_confirmation' => 'required|same:password',
        ]);
        if(empty($request->newsletter))
        {
            $newsletter='0';
        }
        else
        {
            $newsletter='1';
            Newsletter::create([
            'email' => $request['email'],
        ]);
        }
    	
        User::create([
            'user_name' => $request['first_name'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'date_birth' => $request['birthdate'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'user_status' =>'0',
            'newsletter_subscription' => $newsletter,
            'verification_code' =>$request['_token'],
        ]);

        $details=[
            'name' => $request['first_name'],
            'email' => $request['email'],
            'verification_code' =>$request['_token'],
            'body' => 'This is for testing mail'
            ];

        Mail::to($request['email'])->send(new RegisterMail($details));

       return redirect('/login')->with('success','A verification link has been sent to your email account');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        $verify = User::where('email',$request->email)->where('user_status','1')->first();
        $unverify = User::where('email',$request->email)->where('user_status','0')->first();
        if($verify)
        {
                if(Hash::check($request->password, $verify->password))
                {
                    $request->session()->put('customer_auth',$verify);
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
                                 $get_cart=Cart::where('user_id',$verify->id)->where('product_id',$cookie_product_id_array[$i])->first();
                                 if(empty($get_cart))
                                 {
                                    Cart::create(
                                    [
                                        'user_id' => $verify->id,
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
                            return redirect()->route('my-account')->withCookie($cookie)->with('success','Welcome Back.');
                        }
                    
                    return redirect()->route('my-account')->with('success','Welcome Back.');
                }
                else
                {
                    return redirect()->back()
                        ->with('error','Sorry, the password you entered does not match.');
                }
        }
        else
        if($unverify)
        {
            return back()->with('error','Please verify that you entered a valid email address in our register form.');  
        }
        else
        {
            return back()->with('error','Please enter a valid email address');  
        }
    }

    public function logout(){
        if(session()->has('customer_auth'))
        {
            session()->forget('customer_auth');
            return redirect()->route('home')->with('success','You have been logged Out');
        }
        else
        {
            session()->forget('customer_auth');
            return redirect()->route('home');
        }
    }

    
    public function viewcustomer(){
        $all_customer = User::orderBy('id', 'desc')->get();
        return view('admin.pages.customer', compact('all_customer'));
    }

    public function saveuseraddress(Request $request){
        if(session()->has('customer_auth')){
            $session_id=session('customer_auth')->id;
            $new_address= new Useraddress();
            $new_address->user_id=$session_id;
            $new_address->user_name=$request->fullname;
            $new_address->address=$request->address;
            $new_address->phone=$request->phone;
            $new_address->city=$request->city;
            $new_address->state=$request->state;
            $new_address->pincode=$request->pincode;
            $new_address->address_type='2';
            $new_address->default='0';
            $new_address->save();
            echo "1";
        }
    }

    public function updateuseraddress(Request $request){

        if(session()->has('customer_auth')){
            $user_address=Useraddress::where('id',$request->id)->first();
            $user_address->user_name=$request->fullname;
            $user_address->address=$request->address;
            $user_address->phone=$request->phone;
            $user_address->city=$request->city;
            $user_address->state=$request->state;
            $user_address->pincode=$request->pincode;
            $user_address->address_type='2';
            $user_address->default='0';
            $user_address->save();
            
            return redirect()->back()->with('success','Your Address has been updated successfully');
        }
    }

    public function new_mail(Request $request)
    {
         $details=[
           'title' => 'mail Fom Abhishek',
            'body' => 'This is for testing mail'
            ];
        Mail::to("abhisheksaha.led@gmail.com")->send(new RegisterMail($details));

        return "success";
    }

    public function newsletter(NewsletterRequest $request)
    {
        Newsletter::create($request->all());
        return redirect()->back()->with('success','Newsletter Successfully.');
    }

    protected function allowMaxQuantity(){
        $maximum_quantity=EcommerceSetting::first();
        return $maximum_quantity->maximum_quantity;
    }

    public function verify($email, $code){
        $verify = User::where('email',$email)->where('verification_code',$code)->first();
        if($verify){
            $verify->user_status='1';
            $verify->verification_code =null;
            $verify->save();
            return redirect()->route('login')->with('success','Congrats! Your email is verified. You can now login.');
        }
    else
        {
            return redirect()->route('login')->with('error','Please enter a valid link sent to your email account.');   
        }
    }

    public function forgot_password(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:100',
        ]);
        $check = User::where('email',$request->email)->first();
        if($check)
        {
            $check->verification_code = $request['_token'];
            $check->save();

            $details=[
            'name' => $check['first_name'],
            'email' => $request['email'],
            'verification_code' =>$request['_token'],
            ];

        Mail::to($request['email'])->send(new ForgotPasswordMail($details));

            return redirect('/login')->with('success','A verification link has been sent to your email account');
        }   
        else
        {
            return back()->with('error','Please enter a valid email address');
        }
    }

    public function changepassword($email, $code)
    {
        $verify = User::where('email',$email)->where('verification_code',$code)->first();
        if($verify){
            return view('frontend.pages.changepassword', compact('email','code'));
        }
    else
        {
            return redirect()->route('login')->with('error','Please enter a valid link sent to your email account.');   
        }
    }

    public function updatepassword(Request $request)
    {
        $verify = User::where('email',$request->email)->where('verification_code',$request->code)->first();
        if($verify){
            $request->validate([
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|same:new_password',
            ]);
            $verify->password=bcrypt($request['new_password']);
            $verify->user_status='1';
            $verify->verification_code =null;
            $verify->save();
            return redirect()->route('login')->with('success','Success! Your Password has been changed! You can now login.');
        }
    else
        {
            return redirect()->back()->with('error','Please enter a valid link sent to your email account.');   
        }
    }

    // Google login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Google callback
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        $this->_registerOrLoginUser($user);

        // Return my account after login
        return redirect()->route('my-account');
    }

    protected function _registerOrLoginUser($data)
    {
        $user = User::where('email',$data->email)->first();
        if (!$user) {
            $user = new User();
            $user->user_name = $data->name;
            $user->first_name = $data->name;
            $user->last_name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->user_status = '1';
            $user->save();

            Newsletter::create([
            'email' => $user->email,
            ]);
        }
        session(['customer_auth'=>$user]);
    }

    public function changestatus(Request $request, User $user)
    {
        $user->user_status=$user->user_status=='1'?'0':'1';
        $user->save();
        if($user->user_status=='1')
        {
            return redirect()->back()->with('success','User is active now');
        }
        else
        if($user->user_status=='0')
        {
            return redirect()->back()->with('error','User is disbale now');   
        }
    }
}
