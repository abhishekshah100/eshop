<?php

namespace App\Http\Controllers;

use App\admin_credentials;
use App\Product;
use App\ProductOrder;
use App\Category;
use App\Brand;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function requestvendor(){
        $non_verify_vendor=admin_credentials::where('account_verify_status','0')->get();
        return view('admin.pages.vendor.requestvendor', compact('non_verify_vendor'));
    }

    public function viewvendor(){
        $verify_vendor=admin_credentials::where('account_verify_status','1')->get();
        return view('admin.pages.vendor.viewvendor', compact('verify_vendor'));
    }

    public function approvevendor($id){
        $check_vendor=admin_credentials::findorFail($id);
        $check_vendor->account_verify_status='1';
        $check_vendor->save();

        return redirect()->back()->with('success',$check_vendor->fullname.' vendor has been approved');
    }

    public function requestproduct(){
    	$brand = Brand::where('brand_status','1')->get();
        $category = Category::where('category_status','1')->get();
        return view('admin.pages.products.add_product', compact('brand','category'));
    }

    public function adminaddvendor(){
        return view('admin.pages.vendor.add_vendor');
    }

    public function adminaddpostvendor(Request $request){
        $request->validate([
            'full_name' => 'required|string|max:150',
            'email' => 'required|string|email|max:100|unique:admin_credentials',
            'phone_number' => 'required|numeric|regex:/[7-9]{1}[0-9]{9}/|digits:10',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|same:password',
            'company_type' => 'required',
        ]);
        if($request->company_type=='1')
        {
            $request->validate([
                'company_address' => 'required|string|max:100',
                'company_city' => 'required',
                'company_country' => 'required|string',
                'company_state' => 'required|string',
                'company_pincode' => 'required',
            ]);
        }
        $data = $request->all();
        $data['role'] ='2';
        $data['company_phonenumber'] = $request->phone_number;
        $data['account_verify_status'] = '0';
        admin_credentials::create($data);
        return redirect()->back()->with('success','Vendor has been added successfully');
    }
}
