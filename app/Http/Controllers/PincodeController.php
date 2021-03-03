<?php

namespace App\Http\Controllers;

use App\Pincode;
use App\Useraddress;
use Illuminate\Http\Request;

class PincodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.pincode')->with('pincodes',Pincode::latest()->get());
    }

    public function checkpincodeapi(Request $request){
        $pincode= $request->pincode;
        $data=file_get_contents('http://postalpincode.in/api/pincode/'.$pincode);
            $data=json_decode($data);
            if(isset($data->PostOffice['0'])){
                $arr['city']=$data->PostOffice['0']->Taluk;
                $arr['state']=$data->PostOffice['0']->State;
                $arr['country']=$data->PostOffice['0']->Country;
                echo json_encode($arr);
            }else{
                echo 'no';
            }
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
            'pincode' => 'required|numeric',
            'delivery_status' => 'required|numeric',
            'delivery_in_days' => 'required|numeric',
            'minimum_order' => 'required|numeric',
            'delivery_charges' => 'required|numeric',
        ]);
        $data=$request->all();
        if($request->pincode_status=='on')
        {
            $data['pincode_status']='1';
        }
        else
        {
            $data['pincode_status']='0';
        }
        $pincode_exist=Pincode::where('pincode',$request->pincode)->count();
        if($pincode_exist=='0')
        {
            Pincode::create($data);
            return redirect()->back()->with('success','Pin Code has been Added Successfully');
        }
        else
        {
            return redirect()->back()->with('error','Pin Code has been already added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pincode  $pincode
     * @return \Illuminate\Http\Response
     */
    public function show(Pincode $pincode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pincode  $pincode
     * @return \Illuminate\Http\Response
     */
    public function edit(Pincode $pincode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pincode  $pincode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pincode $pincode)
    {
        $request->validate([
            'pincode' => 'required|numeric',
            'delivery_status' => 'required|numeric',
            'delivery_in_days' => 'required|numeric',
            'minimum_order' => 'required|numeric',
            'delivery_charges' => 'required|numeric',
        ]);
        $data=$request->all();
        if($request->pincode_status=='on')
        {
            $data['pincode_status']='1';
        }
        else
        {
            $data['pincode_status']='0';
        }
        $pincode_exist=Pincode::where('pincode',$request->pincode)->where('id','<>',$pincode->id)->count();
        if($pincode_exist=='0')
        {
            $pincode->update($data);
            return redirect()->back()->with('success','Pin Code has been updated successfully');
        }
        else
        {
            return redirect()->back()->with('error','Pin Code has been already added');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pincode  $pincode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pincode $pincode)
    {
        $pincode->delete();
        return redirect()->back()->with('success','Pin Code has been Deleted Successfully');
    }

    public function getdeliveryinformation(Request $request){
        $total_amount= $request->totalAmount;
        $get_pincode=Useraddress::where('id',$request->useraddress)->select('pincode')->first();
        $check_pincode=Pincode::where('pincode',$get_pincode->pincode)->where('pincode_status','1')->first();
        if($check_pincode)
        {
            if($total_amount>=$check_pincode->minimum_order)
            {
                $check_pincode->delivery_charges=0;
            }
            return json_encode($check_pincode);
        }
        else
        {
            return "no";
        }
    }

    public function changestatus(Pincode $pincode)
    {
        $pincode->pincode_status=$pincode->pincode_status=='1'?'2':'1';
        $pincode->save();
        if($pincode->pincode_status=='1')
        {
            return redirect()->back()->with('success','Pincode is active now');
        }
        else
        if($pincode->pincode_status=='2')
        {
            return redirect()->back()->with('error','Pincode is disbale now');   
        }
    }
}
