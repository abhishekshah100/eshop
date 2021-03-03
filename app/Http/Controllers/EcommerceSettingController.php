<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EcommerceSetting;

class EcommerceSettingController extends Controller
{
    public function othersettings(){
        $maximum_quantity=EcommerceSetting::first();
        return view('admin.pages.websiteui.stock_settings', compact('maximum_quantity'));
    }

    public function updateothersettings(Request $request){
    	$request->validate([
            'maximum_quantity' => 'required|numeric',
            'pagination' => 'required|numeric',
        ]);
        $update_other_settings=EcommerceSetting::findOrFail(1);
        $update_other_settings->maximum_quantity=$request->maximum_quantity;
        $update_other_settings->pagination=$request->pagination;
        $update_other_settings->save();

        return redirect()->back()->with('success','Other Settings has been updated');
    }
}
