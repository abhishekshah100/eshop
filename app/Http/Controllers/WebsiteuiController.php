<?php

namespace App\Http\Controllers;

use App\Websiteui;
use App\Homeslider;
use App\WebsiteSetting;
use Image;
use App\Http\Requests\WebsiteSettings;
use Illuminate\Http\Request;

class WebsiteuiController extends Controller
{
    public function frontendhomeui(){
        $home_sliders=Homeslider::all();
        $premium_product=Websiteui::where('id','1')->first();
        $array_premium_images=explode(',',$premium_product->websiteui_images);
        $array_premium_link=explode(',',$premium_product->websiteui_link);
        $popular_category=Websiteui::where('id','2')->first();
        $offer_banners=Websiteui::where('id','3')->first();
        $array_offer_banners_images=explode(',',$offer_banners->websiteui_images);
        $array_offer_banners_link=explode(',',$offer_banners->websiteui_link);
        
        return view('admin.pages.websiteui.homepage', compact('home_sliders','array_premium_images','array_premium_link','popular_category','array_offer_banners_images','array_offer_banners_link'));
    }

    public function homeuiaddslider(Request $request){
        $request->validate([
            'main_heading' => 'required|max:40',
            'sub_heading' => 'required|max:40',
            'sub_sub_heading' => 'required|max:40',
            'slider_link' => 'required',
            'slider_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slider_status' => 'required',
        ]);

        if($request->hasFile('slider_image'))
        {
            $folder='images/websiteui/slider_images/';
            $image = $request->file('slider_image');
            $filename = time() . '-' .$image->getClientOriginalName();
            $path = public_path($folder . $filename);
            Image::make($image->getRealPath())->resize(1920, 610)->save($path);
            $path_image = $folder.$filename;
        }

        Homeslider::create([
            'main_heading' => ucwords($request->main_heading),
            'sub_heading' => ucwords($request->sub_heading),
            'sub_sub_heading' => ucwords($request->sub_sub_heading),
            'link' => $request->slider_link,
            'slider_image' => $path_image,
            'status' =>$request->slider_status,
        ]);

        return redirect()->route('frontend-home-ui')
                        ->with('success','Slider has been added successfully.');
    }

    public function homeuieditslider(Request $request, $id){
        $homeslider = Homeslider::findOrFail($id);
        $request->validate([
            'main_heading' => 'required|max:40',
            'sub_heading' => 'required|max:40',
            'sub_sub_heading' => 'required|max:40',
            'slider_link' => 'required',
            'slider_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slider_status' => 'required',
        ]);
        if($request->hasFile('slider_image'))
        {
            unlink($homeslider->slider_image);
            $folder='images/websiteui/slider_images/';
            $image = $request->file('slider_image');
            $filename = time() . '-' .$image->getClientOriginalName();
            $path = public_path($folder . $filename);
            Image::make($image->getRealPath())->resize(1920, 610)->save($path);
            $path_image = $folder.$filename;
        }
        if(empty($request->slider_image))
        {
            $path_image=$homeslider->slider_image;
        }
        $homeslider->main_heading= ucwords($request->main_heading);
        $homeslider->sub_heading= ucwords($request->sub_heading);
        $homeslider->sub_sub_heading= ucwords($request->sub_sub_heading);
        $homeslider->link= $request->slider_link;
        $homeslider->slider_image= $path_image;
        $homeslider->status= $request->slider_status;
        $homeslider->save();

        return redirect()->route('frontend-home-ui')
                        ->with('success','Slider has been updated successfully.');
    }

    public function homeuieditpremium(Request $request, $id){
        $premium_product=Websiteui::where('id',1)->first();
        $request->validate([
            'premium_product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'premium_product_link' => 'required',
        ]);

        if($request->hasFile('premium_product_image'))
        {
            $folder='images/websiteui/premium_products/';
            $image = $request->file('premium_product_image');
            $filename = time() . '-' .$image->getClientOriginalName();
            $path = public_path($folder . $filename);
            Image::make($image->getRealPath())->resize(450, 300)->save($path);
            $path_image = $folder.$filename;
        }
        $array_premium_images=explode(',',$premium_product->websiteui_images);
        $array_premium_link=explode(',',$premium_product->websiteui_link);

        if(empty($request->premium_product_image))
        {
            $path_image=$array_premium_images[$id];
        }
        
        $array_premium_images[$id]=$path_image;
        $array_premium_link[$id]=$request->premium_product_link;
        $premium_images=implode(',', $array_premium_images);
        $premium_link=implode(',', $array_premium_link);
        $premium_product->websiteui_link= $premium_link;
        $premium_product->websiteui_images= $premium_images;
        $premium_product->save();

        return redirect()->route('frontend-home-ui')->with('success','Premium Product has been updated successfully.');
    }

    public function homeuieditcategoryproduct(Request $request){
        $id='2';
        $popular_category=Websiteui::where('id',$id)->first();
        $request->validate([
            'popular_category_image' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($request->hasFile('popular_category_image'))
        {
            unlink($popular_category->websiteui_images);
            $folder='images/websiteui/popular_categories/';
            $image = $request->file('popular_category_image');
            $filename = time() . '-' .$image->getClientOriginalName();
            $path = public_path($folder . $filename);
            Image::make($image->getRealPath())->resize(1920, 885)->save($path);
            $path_image = $folder.$filename;
        }
        if(empty($request->popular_category_image))
        {
            $path_image=$popular_category->websiteui_images;
        }
        $popular_category->websiteui_images= $path_image;
        $popular_category->save();

        return redirect()->route('frontend-home-ui')
                        ->with('success','Popular Category has been updated successfully.');
    }

    public function homeuieditofferbanners(Request $request, $id){
        $offer_banners=Websiteui::where('id',3)->first();
        $request->validate([
            'offer_banners_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'offer_banners_link' => 'required',
        ]);

        if($request->hasFile('offer_banners_image'))
        {
            $folder='images/websiteui/offer_banners/';
            $image = $request->file('offer_banners_image');
            $filename = time() . '-' .$image->getClientOriginalName();
            $path = public_path($folder . $filename);
            Image::make($image->getRealPath())->resize(690, 225)->save($path);
            $path_image = $folder.$filename;
        }

        $array_offer_images=explode(',',$offer_banners->websiteui_images);
        $array_offer_link=explode(',',$offer_banners->websiteui_link);

        if(empty($request->offer_banners_image))
        {
            $path_image=$array_offer_images[$id];
        }
        
        $array_offer_images[$id]=$path_image;
        $array_offer_link[$id]=$request->offer_banners_link;
        $offer_images=implode(',', $array_offer_images);
        $offer_link=implode(',', $array_offer_link);
        $offer_banners->websiteui_link= $offer_link;
        $offer_banners->websiteui_images= $offer_images;
        $offer_banners->save();

        return redirect()->route('frontend-home-ui')->with('success','Offer Banners has been updated successfully.');
    }

    public function showurl(){
        $website_setting=WebsiteSetting::first();
        return view('admin.pages.websiteui.website_settings', compact('website_setting'));
    }

    public function updatewebsitesettings(WebsiteSettings $request){
        $website_settings=WebsiteSetting::where('id','1')->first();
        if(empty($request['website_logo']))
        {
            $logo_image=$website_settings->website_logo;
        }
        else
        {
            $logo_image = $this->imageuploadWebsiteLogo($request);
        }
        $website_settings->website_url=rtrim($request->website_url,"/");
        $website_settings->website_logo=$logo_image;
        $website_settings->website_name=$request->website_name;
        $website_settings->website_email=$request->website_email;
        $website_settings->contactno=$request->contactno;
        $website_settings->address=$request->address;
        $website_settings->state=$request->state;
        $website_settings->pincode=$request->pincode;
        $website_settings->facebook_url=$request->facebook_url;
        $website_settings->twitter_url=$request->twitter_url;
        $website_settings->youtube_url=$request->youtube_url;
        $website_settings->instagram_url=$request->instagram_url;
        $website_settings->save();

        return redirect()->route('show-url')->with('success','Website settings has been updated successfully.');

    }

    public function adminsliderimages(Request $request)
    {
    	dd($request->input());
    	$request->validate([
            'slider_images' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        //  if($request->hasfile('slider_images'))
        //  {
        //     foreach($request->file('slider_images') as $file)
        //     {
        //         $name = time().'.'.$file->extension();
        //         $file->move(public_path().'/images/', $name);  
        //         $data[] = $name;  
        //     }
        //  }
        // $slider_images = Websiteui::findOrFail(1);
        // $slider_images->slider_images=json_encode($data);
        // $slider_images->save();
        
        // return redirect()->route('frontend-home-ui')
        //                 ->with('success','Slider Images has been updated successfully.');
    }

    protected function imageuploadWebsiteLogo(Request $request)
    {
        if($request->hasFile('website_logo'))
        {
            $folder='images/website/logo/';
            $image = $request->file('website_logo');
            $filename = time() . '-' .$image->getClientOriginalName();
            $path = public_path($folder . $filename);
            Image::make($image->getRealPath())->resize(137, 36)->save($path);
            $path_image = $folder.$filename;
        }
        return $filename;
    }

    public function homesliderdestroy(Homeslider $homeslider){
        unlink($homeslider->slider_image);
        Homeslider::destroy($homeslider->id);
        return redirect()->back()->with('success','Home SLider has been deleted');
    }
}
