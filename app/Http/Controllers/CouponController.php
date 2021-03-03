<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.coupons')->with('coupons',Coupon::latest()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'discount_percentage' => 'required|numeric',
            'discount_amount_upto' => 'required|numeric',
            'coupon_code' => 'required|string|max:15',
            'starting_date' => 'required|date_format:Y-m-d',
            'ending_date' => 'required|date_format:Y-m-d',
            'minimum_amount' => 'required|numeric',
            'use_per_customer' => 'required|numeric',
        ]);
        $data=$request->all();
        if($request->coupon_status=='on')
        {
            $data['coupon_status']='1';
        }
        else
        {
            $data['coupon_status']='0';
        }
        $present_date=date("Y-m-d");
        $coupon_exist=Coupon::where('coupon_code',$request->coupon_code)->whereRaw('"'.$present_date.'" between `starting_date` and `ending_date`')->count();
        if($coupon_exist=='0')
        {
            Coupon::create($data);
            return redirect()->back()->with('success','Coupon has been Added Successfully');
        }
        else
        {
            return redirect()->back()->with('error','Coupon has been already added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'discount_percentage' => 'required|numeric',
            'discount_amount_upto' => 'required|numeric',
            'coupon_code' => 'required|string|max:15',
            'starting_date' => 'required|date_format:Y-m-d',
            'ending_date' => 'required|date_format:Y-m-d',
            'minimum_amount' => 'required|numeric',
            'use_per_customer' => 'required|numeric',
        ]);
        $data=$request->all();
        if($request->coupon_status=='on')
        {
            $data['coupon_status']='1';
        }
        else
        {
            $data['coupon_status']='0';
        }
        $present_date=date("Y-m-d");
        $coupon_exist=Coupon::where('coupon_code',$request->coupon_code)->whereRaw('"'.$present_date.'" between `starting_date` and `ending_date`')->where('id', '<>', $coupon->id)->count();
        if($coupon_exist=='0')
        {
            $coupon->update($data);
            return redirect()->back()->with('success','Coupon has been Updated Successfully');
        }
        else
        {
            return redirect()->back()->with('error','Coupon has been already added');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->back()->with('success','Coupon has been Deleted Successfully');
    }

    public function changestatus(Request $request, Coupon $coupon)
    {
        $coupon->coupon_status=$coupon->coupon_status=='1'?'2':'1';
        $coupon->save();
        if($coupon->coupon_status=='1')
        {
            return redirect()->back()->with('success','Coupon is active now');
        }
        else
        if($coupon->coupon_status=='2')
        {
            return redirect()->back()->with('error','Coupon is disbale now');   
        }
    }
}
