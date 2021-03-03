<?php

namespace App\Http\Controllers;

use App\SubCategory;
use App\Category;
use Image;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategory=SubCategory::latest()->get();
        $category=Category::where('category_status','1')->get();
        return view('admin.pages.sub_category', compact('subcategory','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.sub_category');
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
            'category_id' => 'required',
            'sub_categoryname' => 'required|max:18|unique:sub_categories',
            'sub_category_status' => 'required',
            'metatitle' => 'required|unique:sub_categories',
            'metadescription' => 'required|unique:sub_categories',
            'metakeywords' => 'required|unique:sub_categories',
            'metacanonical' => 'required|unique:sub_categories',
            'sub_category_image' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = $request->all();
        $data['sub_category_image'] = $this->imageuploadSubCategory($request);
        SubCategory::create($data);

        return redirect()->route('sub_category.index')->with('success','Sub Category has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'category_id' => 'required',
            'sub_categoryname' => 'required|max:18',
            'sub_category_status' => 'required',
            'metatitle' => 'required',
            'metacanonical' => 'required',
            'metakeywords' => 'required',
            'metadescription' => 'required',
            'sub_category_image' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        if(!empty($data['sub_category_image']))
        {
            unlink($subCategory->sub_category_image);
            $data['sub_category_image'] = $this->imageuploadSubCategory($request);
        }

        $subCategory->update($data);
        return redirect()->route('sub_category.index')->with('success','Sub Category has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        unlink($subCategory->sub_category_image);
        SubCategory::destroy($subCategory->id);
        return redirect()->back()->with('success','Sub Catgeory has been deleted');
    }

    public function changestatus(SubCategory $subCategory)
    {
        $subCategory->sub_category_status=$subCategory->sub_category_status=='1'?'2':'1';
        $subCategory->save();
        if($subCategory->sub_category_status=='1')
        {
            return redirect()->back()->with('success','Sub Category is active now');
        }
        else
        if($subCategory->sub_category_status=='2')
        {
            return redirect()->back()->with('error','Sub Category is disbale now');   
        }
    }

    protected function imageuploadSubCategory(request $request)
    {
        if($request->hasFile('sub_category_image'))
        {
            $folder='images/sub_category/';
            $image = $request->file('sub_category_image');
            $filename = time() . '-' .$image->getClientOriginalName();
            $path = public_path($folder . $filename);
            Image::make($image->getRealPath())->resize(228, 228)->save($path);
            $path_image = $folder.$filename;
        }
        return $filename;
    }
}
