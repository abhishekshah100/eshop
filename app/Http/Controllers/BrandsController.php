<?php

namespace App\Http\Controllers;

use App\Brand;
use Image;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.brands')->with('brand', Brand::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.brands');
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
            'brandname' => 'required|unique:brands',
            'brand_status' => 'required',
            'metatitle' => 'required|unique:brands',
            'metadescription' => 'required|unique:brands',
            'metakeywords' => 'required|unique:brands',
            'metacanonical' => 'required|unique:brands',
            'brand_logo' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = $request->all();
        $data['brand_logo'] = $this->imageuploadBrand($request);
        Brand::create($data);
        return redirect()->route('brand.index')->with('success','Brand has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'brandname' => 'required',
            'brand_status' => 'required',
            'metatitle' => 'required',
            'metacanonical' => 'required',
            'metakeywords' => 'required',
            'metadescription' => 'required',
            'brand_logo' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = $request->all();
        if(!empty($data['brand_logo']))
        {
            unlink($brand->brand_logo);
            $data['brand_logo'] = $this->imageuploadBrand($request);
        }
        $brand->update($data);
        return redirect()->route('brand.index')->with('success','Brand has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        unlink($brand->brand_logo);
        Brand::destroy($brand->id);
        return redirect()->back()->with('success','Brand has been deleted');
    }

    public function changestatus(Brand $brand)
    {
        $brand->brand_status=$brand->brand_status=='1'?'2':'1';
        $brand->save();
        if($brand->brand_status=='1')
        {
            return redirect()->back()->with('success','Brand is active now');
        }
        else
        if($brand->brand_status=='2')
        {
            return redirect()->back()->with('error','Brand is disbale now');   
        }
    }

    protected function imageuploadBrand(request $request)
    {
        if($request->hasFile('brand_logo'))
        {
            $folder='images/brand/';
            $image = $request->file('brand_logo');
            $filename = time() . '-' .$image->getClientOriginalName();
            $path = public_path($folder . $filename);
            Image::make($image->getRealPath())->resize(195, 70)->save($path);
            $path_image = $folder.$filename;
        }
        return $filename;
    }
}
