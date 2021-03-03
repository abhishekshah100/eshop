<?php

namespace App\Http\Controllers;

use App\Category;
use Image;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.category')->with('category', Category::latest()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.category');
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
            'categoryname' => 'required|max:18|unique:categories',
            'category_status' => 'required',
            'metatitle' => 'required|unique:categories',
            'metadescription' => 'required|unique:categories',
            'metakeywords' => 'required|unique:categories',
            'metacanonical' => 'required|unique:categories',
            'category_image' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = $request->all();
        $data['category_image'] = $this->imageuploadCategory($request);
        Category::create($data);

        return redirect()->route('category.index')
                        ->with('success','Category has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Category $category)
    {
        $request->validate([
            'categoryname' => 'required|max:18',
            'category_status' => 'required',
            'metatitle' => 'required',
            'metacanonical' => 'required',
            'metakeywords' => 'required',
            'metadescription' => 'required',
            'category_image' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        if(!empty($data['category_image']))
        {
            unlink($category->category_image);
            $data['category_image'] = $this->imageuploadCategory($request);
        }

        $category->update($data);
        return redirect()->route('category.index')->with('success','Category has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        unlink($category->category_image);
        Category::destroy($category->id);
        return redirect()->back()->with('success','Catgeory has been deleted');
    }

    public function changestatus(Category $category)
    {
        $category->category_status=$category->category_status=='1'?'2':'1';
        $category->save();
        if($category->category_status=='1')
        {
            return redirect()->back()->with('success','Category is active now');
        }
        else
        if($category->category_status=='2')
        {
            return redirect()->back()->with('error','Category is disbale now');   
        }
    }

    protected function imageuploadCategory(request $request)
    {
        if($request->hasFile('category_image'))
        {
            $folder='images/category/';
            $image = $request->file('category_image');
            $filename = time() . '-' .$image->getClientOriginalName();
            $path = public_path($folder . $filename);
            Image::make($image->getRealPath())->resize(228, 228)->save($path);
            $path_image = $folder.$filename;
        }
        return $filename;
    }
}
