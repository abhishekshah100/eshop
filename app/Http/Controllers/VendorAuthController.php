<?php

namespace App\Http\Controllers;
use App\admin_credentials;
use Illuminate\Http\Request;

class VendorAuthController extends Controller
{
    public function register(){
    	return view('admin.pages.register');
    }

    public function login(){
    	return view('admin.pages.login');
    }

    public function postregister(Request $request){
    	$request->validate([
            'full_name' => 'required|string|max:150',
            'email' => 'required|string|email|max:100|unique:admin_credentials',
            'phone_number' => 'required|numeric|regex:/[7-9]{1}[0-9]{9}/|digits:10',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|same:password',
        ]);
        
        $data = $request->all();
        $data['company_phonenumber'] = $request->phone_number;
        $data['password'] = bcrypt($request->password);

        $request->session()->put('vendor_auth',$data);
        return redirect()->route('vendor-company');
    }

    public function companydetails(){
        if(session()->has('vendor_auth'))
        {
            return view('vendor.companypage');
        }
        else
        {
            return redirect()->route('vendor-register');
        }
    }

    public function postcompanydetails(Request $request){
        if(session()->has('vendor_auth'))
        {
            $request->validate([
            'company_type' => 'required',
            'company_address' => 'required|string|max:100',
            'company_city' => 'required',
            'company_country' => 'required|string',
            'company_state' => 'required|string',
            'company_pincode' => 'required',
            ]);

            $data =session('vendor_auth');
            $data['company_type']=$request->company_type;
            $data['company_address']=$request->company_address;
            $data['company_city']=$request->company_city;
            $data['company_country']=$request->company_country;
            $data['company_state']=$request->company_state;
            $data['company_pincode']=$request->company_pincode;
            $data['role'] = '2';
            $data['account_verify_status'] = '0';

            admin_credentials::create($data);

            return redirect()->route('admin-login');
        }
        else
        {
            return redirect()->route('vendor-register');
        }
    }
}
