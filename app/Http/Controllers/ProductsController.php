<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
//Models
use App\Setting;
use App\Category;
use App\Product;
use App\Product_Image;
use App\Product_Local;
class ProductsController extends Controller{
    private function getAllTags(){
        $TagsList = Product::all()->pluck('tags');
        $MasterTagsArray = [];
        foreach($TagsList as $Tag){
            $Tag = explode(',' , $Tag );
            $CleanTag = array_unique($Tag);
            //Push to the master array 
            array_push($MasterTagsArray , $CleanTag);
        }
        if(empty($MasterTagsArray)){
            $MasterTagsArray = [[], []];
        }
        $ReadyToUseTagsArray = array_unique($FinalMasterTagsArray = call_user_func_array('array_merge', $MasterTagsArray));
        return $ReadyToUseTagsArray;
    }
    public function getHome(){
        $Products = Product::latest()->get();
        return view('admin.product.index' , compact('Products'));
    }
    public function getNew(){
        $AllCategories = Category::latest()->get();
        $NextProductIdQuery = Product::latest()->first();
        if($NextProductIdQuery == null){
            $NextProductId = 1;
        }else{
            $NextProductId = $NextProductIdQuery->id + 1;
        }
        $ReadyToUseTagsArray = $this->getAllTags();
        return view('admin.product.new' , compact('AllCategories' , 'NextProductId' , 'ReadyToUseTagsArray'));
    }
    public function postNew(Request $r){
        // dd($r->all());
        //Validate the request
        $Rules = [
            'title' => 'required|min:5|max:255',
            'slug' => 'required|min:5|max:255|unique:products',
            'description' => 'required|min:25',
            'body' => 'required|min:40',
            'id' => 'required|integer',
            'price' => 'required|numeric',
            'inventory' => 'required|numeric',
            'min_order' => 'required|numeric',
            'weight' => 'numeric',
            'height' => 'numeric',
            'width' => 'numeric',
            'tax_rate' => 'required',
            'image' => 'image|max:45000000'
        ];
        $validator = Validator::make($r->all() , $Rules);
        if($validator->fails()){
            return back()->withErrors($validator->errors()->all())->withInput();
        }else{
            //Prepare The Data For Uploading
            $ProductData = $r->except('custom_tags');
            //Handle The Image
            if($r->has('image')){
                $ProductData['image'] = $r->slug.'.'.$r->image->getClientOriginalExtension();
                $r->image->storeAs('images/products' , $ProductData['image']);
            }else{
                $ProductData['image'] = 'product.png';
            }
            $ProductData['slug'] = strtolower(str_replace(' ' , '-' , $r->slug));
            $ProductData['tags'] = implode(',' , $r->tags) .','. $r->custom_tags;
            $ProductData['show_inventory'] = ($r->show_inventory == 'on') ? 1 : 0;
            $ProductData['is_promoted'] = ($r->is_promoted == 'on') ? 1 : 0;
            $ProductData['allow_reviews'] = ($r->allow_reviews == 'on') ? 1 : 0;
            $ProductData['allow_reservations'] = ($r->allow_reservations == 'on') ? 1 : 0;
            $ProductData['user_id'] = auth()->user()->id;
            $NewProduct = Product::create($ProductData);
            return redirect()->route('admin.products.home')->withSuccess('Product Created Successfully !');
        }
    }
    //Edit 
    public function getEdit($id){
        $ProductData = Product::findOrFail($id);
        $AllCategories = Category::latest()->get();
        $ReadyToUseTagsArray = $this->getAllTags();
        return view('admin.product.edit' , compact('ProductData' ,'AllCategories' , 'ReadyToUseTagsArray'));
    }
    public function postEdit(Request $r , $id){
        $TheProduct = Product::find($id);
        //Validate the request
        $Rules = [
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:25',
            'body' => 'required|min:40',
            'id' => 'required|integer',
            'price' => 'required|numeric',
            'inventory' => 'required|numeric',
            'min_order' => 'required|numeric',
            'weight' => 'numeric',
            'height' => 'numeric',
            'width' => 'numeric',
            'tax_rate' => 'required',
            'image' => 'image|max:45000000'
    ];
    $validator = Validator::make($r->all() , $Rules);
    if($validator->fails()){
        return back()->withErrors($validator->errors()->all())->withInput();
    }else{
        //Prepare The Data For Uploading
        $ProductData = $r->except('custom_tags');
        //Handle The Image
        if($r->has('image')){
            $ProductData['image'] = $TheProduct->slug.'.'.$r->image->getClientOriginalExtension();
            $r->image->storeAs('images/products' , $ProductData['image']);
        }else{
            $ProductData['image'] = $TheProduct->image;
        }
        $ProductData['tags'] = implode(',' , $r->tags) .','. $r->custom_tags;
        $ProductData['show_inventory'] = ($r->show_inventory == 'on') ? 1 : 0;
        $ProductData['is_promoted'] = ($r->is_promoted == 'on') ? 1 : 0;
        $ProductData['allow_reviews'] = ($r->allow_reviews == 'on') ? 1 : 0;
        $ProductData['allow_reservations'] = ($r->allow_reservations == 'on') ? 1 : 0;
        $ProductData['user_id'] = auth()->user()->id;
        $TheProduct->update($ProductData);
        return redirect()->route('admin.products.home')->withSuccess('Product Updated Successfully !');
    }
}
    //Delete
    public function delete(Request $r){
        Product::findOrFail($r->item_id)->delete();
        return response('Product Deleted');
    }
    //Upload Gallery Images
    public function uploadGalleryImages(Request $r){
        //Validate the Request 
        $Rules = [
            'image' => 'required|image|max:45000000',
            'product_id' => 'required'
        ];
        $validator = Validator::make($r->all() , $Rules);
        if($validator->fails()){
            return response($validator->errors()->first());
        }else{
            //Store the image in the file system
            $ImageName = $r->product_id.'-'.rand(1,999).'.'.$r->image->getClientOriginalExtension();
            $r->image->storeAs('images/products/gallery' , $ImageName);
            //Upload to the database
            Product_Image::create([
                'product_id' => $r->product_id,
                'image' => $ImageName
            ]);
            return response('Image Uploaded');
        }
    }
    //Localize
    public function getLocalize($id){
        $Product = Product::findOrFail($id);
        $SystemLangs = explode(',' , Setting::where('title' , 'languages_list')->first()->value);
        return view('admin.product.localize' , compact('Product' , 'SystemLangs'));
    }

    public function postLocalize(Request $r){
        $Rules = [
            'title_value' => 'required|min:5|max:255',
            'slug_value' => 'required|min:5|max:255',
            'description_value' => 'required|min:25',
            'body_value' => 'required|min:25',
            'lang_code' => 'required',
            'product_id' => 'required'
        ];
        $validator = Validator::make($r->all() , $Rules);
        if($validator->fails()){
            $Respone = [
                'error' => true,
                'list' => $validator->errors()->all()
            ];
            return response($Respone);
        }else{
            //Check if this is existing and update it accordingly
            $LocalizedData = Product_Local::where('lang_code' , $r->lang_code)->where('product_id' , $r->product_id)->first();
            if($LocalizedData != null){
                //Update
                $LocalizedData->update($r->all());
                $Respone = [
                    'error' => false,
                    'list' => 'Translation Updated'
                ];
                return response($Respone);
            }else{
                //Create
                $NewLocalizedData = Product_Local::create($r->all());
                $Respone = [
                    'error' => false,
                    'list' => 'Translation Created'
                ];
                return response($Respone);
            }
        }
    }
}
