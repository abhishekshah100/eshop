<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductOrder;
use App\Category;
use App\Brand;
use App\Hotdeal;
use App\Productstock;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        $brand = Brand::all();
        $product = Product::latest()->get();
        return view('admin.pages.products.view_products', compact('product','category','brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand = Brand::where('brand_status','1')->get();
        $category = Category::where('category_status','1')->get();
        return view('admin.pages.products.add_product', compact('brand','category'));
    }

    public function categorydata()
    {
        $category_array=array();
        header('Content-Type" => application/json');
        $category=Category::where('category_status','1')->select('categoryname')->get();
        foreach($category as $categories)
        {
            array_push($category_array, $categories->categoryname);
        }
        echo json_encode($category_array);
    }

    public function branddata()
    {
        $brand_array=array();
        header('Content-Type" => application/json');
        $brand=Brand::where('brand_status','1')->select('brandname')->get();
        foreach($brand as $brands)
        {
            array_push($brand_array, $brands->brandname);
        }
        echo json_encode($brand_array);
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
            'product_name' => 'required|max:45|unique:products',
            'product_sku' => 'nullable|max:90',
            'product_category' => 'required',
            'product_brand' => 'required',
            'product_code' => 'required|unique:products',
            'old_price' => 'nullable',
            'new_price' => 'required',
            'discount' => 'nullable|max:3',
            'product_stock' => 'required',
            'feature_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_images' => 'required',
            'product_description' => 'required',
            'metatitle' => 'nullable|unique:products',
            'metadescription' => 'nullable|unique:products|max:160',
            'metakeywords' => 'nullable|unique:products',
            'product_status' => 'required',
        ]);

        $data=$request->all();
        $data['feature_image']=$this->imageuploadProduct($request);
        $data['remaining_stock']=$this->remainingStock($request);
        $data['product_images']=json_encode($this->multipleImageuploadProduct($request));
        $created_product= Product::create($data);

        Productstock::create([
            'product_id' => $created_product->id,
            'quantity' => $request['product_stock'],
        ]);

        return redirect()->route('product.index')->with('success','Product has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $category = Category::all();
        $brand = Brand::all();
        $count_stock=ProductOrder::where('product_id',$product->id)->count();
        return view('admin.pages.products.edit_product', compact('product','category','brand','count_stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required|max:45',
            'product_sku' => 'nullable|max:90',
            'product_category' => 'required',
            'product_brand' => 'required',
            'product_code' => 'required',
            'old_price' => 'nullable',
            'new_price' => 'required',
            'discount' => 'nullable',
            'product_stock' => 'required',
            'feature_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_images' => 'nullable',
            'product_description' => 'required',
            'metatitle' => 'nullable',
            'metadescription' => 'nullable|max:160',
            'metakeywords' => 'nullable',
            'product_status' => 'required',
        ]);

        $data = $request->all();
        $data['remaining_stock']=$this->remainingStock($request);
        if(empty($data['feature_image']))
        {
            $data['feature_imagee']=$product->feature_image;
        }
        else
        {
            $data['feature_image'] = $this->imageuploadProduct($request);
        }
        if(empty($data['product_images']))
        {
            $data['product_images']=$product->product_images;
        }
        else
        {
            $data['product_images'] = $this->multipleImageuploadProduct($request);
            $array_product_images=json_decode($product->product_images,true);     
            $product_images=array_merge($array_product_images, $data['product_images']);
            $data['product_images']=json_encode($product_images);
        }
        $product->update($data);
        return redirect()->route('product.index')->with('success','Product has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    /**  Add Stock  **/
    public function addstock(Request $request, $id)
    {
        $request->validate([
            'stock_value' => 'required|integer',
            'total_stock_value' => 'required|integer',
        ]);
        $product = Product::findOrFail($id);
        $product->product_stock=$product->product_stock+$request->stock_value;
        $product->remaining_stock=$product->remaining_stock+$request->stock_value;
        $product->save();

        Productstock::create([
            'product_id' => $id,
            'quantity' => $request['stock_value'],
        ]);

        return redirect()->route('product.index')->with('success','Stock has been updated successfully');
    }

    protected function imageuploadProduct(request $request)
    {
        if($request->hasFile('feature_image'))
        {
            $folder='images/products/';
            $image = $request->file('feature_image');
            $filename = time() . '-' .$image->getClientOriginalName();
            $path = public_path($folder . $filename);
            Image::make($image->getRealPath())->resize(800, 800)->save($path);
            $path_image = $folder.$filename;
        }
        return $filename;
    }

    protected function multipleImageuploadProduct(Request $request)
    {
        if ($request->hasFile('product_images')) 
            {
                $array_multiple_image=array();
                $allowedfileExtension=['jpeg','jpg','png','gif','svg'];
                foreach($request->file('product_images') as $file)
                    {
                        //get filename with extension
                        $filenamewithextension = $file->getClientOriginalName();
                        //get filename without extension
                        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                        //get file extension
                        $extension = $file->getClientOriginalExtension();
                        $check=in_array($extension,$allowedfileExtension);
                        if($check)
                        {
                            $folder='images/products/';
                            $filename = time() . '-' .$file->getClientOriginalName();
                            array_push($array_multiple_image, $filename);
                            $path = public_path($folder . $filename);
                            Image::make($file->getRealPath())->resize(800, 800)->save($path);
                            $path_image = $folder.$filename;
                        }
                    }
            }
        return $array_multiple_image;
    }

    protected function remainingStock($request)
    {
        return $request->product_stock;
    }

    public function hotdeal()
    {
        $hot_deal_product = Product::where('hot_deals','1')->get();
        $non_hot_deal_product= $our_product_category= DB::table('categories')
            ->join('products', 'categories.id', '=', 'products.product_category')
            ->where('category_status', '1')->where('product_status', '1')->where('hot_deals','0')->where('remaining_stock','>','0')->get();
        return view('admin.pages.products.hot_deals', compact('hot_deal_product','non_hot_deal_product'));
    }
    
    public function getproductdetail(Request $request)
    {
        $array_product=array();
        $get_product_detail = Product::where('id',$request->product_id)->where('remaining_stock','>','0')->first();
        $array_product['old']=$get_product_detail->old_price;
        $array_product['new']=$get_product_detail->new_price;
        $array_product['discount']=$get_product_detail->discount;
        echo json_encode($array_product);

    }

    public function viewhotdeal(){
        $hot_deals=Hotdeal::latest()->get();
        return view('admin.pages.products.view_hot_deals', compact('hot_deals'));
    }

    public function viewproductstock($id){
        $product=Product::findOrFail($id);
        
        $product_stock=Productstock::where('product_id',$id)->latest()->get();
        return view('admin.pages.products.view_product_stocks', compact('product_stock','product'));
    }

    public function addhotdeal(Request $request){
        $request->validate([
            'productname' => 'required',
            'old_price' => 'nullable',
            'new_price' => 'required',
            'discount' => 'required|max:3',
            'expirydate' => 'required',
        ]);
        $update_product_detail = Product::where('id',$request->productname)->first();
        $update_product_detail->original_old_price = $update_product_detail->old_price;
        $update_product_detail->original_new_price = $update_product_detail->new_price;
        $update_product_detail->original_discount = $update_product_detail->discount;
        $update_product_detail->discount= $request->discount;
        $update_product_detail->old_price= $request->old_price;
        $update_product_detail->new_price=$request->new_price;
        $update_product_detail->hot_deals_expiry_date=$request->expirydate;
        $update_product_detail->hot_deals='1';
        $update_product_detail->save();

        Hotdeal::create([
            'product_id' => $request['productname'],
            'hot_deals_old_price' => $request['old_price'],
            'hot_deals_new_price' => $request['new_price'],
            'hot_deals_discount' => $request['discount'],
            'hot_deals_expiry_date' => $request['expirydate'],
        ]);
        
        return redirect()->route('admin-hot-deal')->with('success','Hot Deals has been added successfully');
    }

    public function edithotdeal(Request $request){
        $request->validate([
            'productname' => 'required',
            'old_price' => 'nullable',
            'new_price' => 'required',
            'discount' => 'required|max:3',
            'expirydate' => 'required',
        ]);
        $update_product_detail = Product::where('id',$request->productname)->first();
        $update_product_detail->discount= $request->discount;
        $update_product_detail->old_price= $request->old_price;
        $update_product_detail->new_price=$request->new_price;
        $update_product_detail->hot_deals_expiry_date=$request->expirydate;
        $update_product_detail->hot_deals='1';
        $update_product_detail->save();

        Hotdeal::create([
            'product_id' => $request['productname'],
            'hot_deals_old_price' => $request['old_price'],
            'hot_deals_new_price' => $request['new_price'],
            'hot_deals_discount' => $request['discount'],
            'hot_deals_expiry_date' => $request['expirydate'],
        ]);

        return redirect()->route('admin-hot-deal')->with('success','Hot Deals has been Updated successfully');
    }

    public function removehotdealproduct(Request $request){
        $remove_hot_deal_product = Product::where('id',$request->product_id)->first();
        $remove_hot_deal_product->old_price = $remove_hot_deal_product->original_old_price;
        $remove_hot_deal_product->new_price = $remove_hot_deal_product->original_new_price;
        $remove_hot_deal_product->discount = $remove_hot_deal_product->original_discount;
        $remove_hot_deal_product->hot_deals_expiry_date= null;
        $remove_hot_deal_product->original_old_price = null;
        $remove_hot_deal_product->original_new_price = null;
        $remove_hot_deal_product->original_discount = null;
        $remove_hot_deal_product->hot_deals='0';
        $remove_hot_deal_product->save();
        echo "1";
    }

    public function changestatus(Product $product)
    {
        $product->product_status=$product->product_status=='1'?'2':'1';
        $product->save();
        if($product->product_status=='1')
        {
            return redirect()->back()->with('success','Product is active now');
        }
        else
        if($product->product_status=='2')
        {
            return redirect()->back()->with('error','Product is disbale now');   
        }
    }

    public function test(){
    return $product= Product::with('brand')->get();
    }
}
