<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use App\Category;
use App\Category_local;
use App\Setting;
class CategoriesController extends Controller{
    public function getHome(){
        $Categories = Category::latest()->get();
        return view('admin.category.index' , compact('Categories'));
    }
    public function getNew(){
        return view('admin.category.new');
    }
    public function postNew(Request $r){
        $Rules = [
            'title' => 'required|min:5|max:255',
            'slug' => 'required|min:5|max:255|unique:categories',
            'image' => 'image',
            'description' => 'required|min:25',
        ];
        $validator = Validator::make($r->all() , $Rules);
        if($validator->fails()){
            return back()->withErrors($validator->errors()->all())->withInput();
        }else{
            //Handle the image upload
            if($r->has('image')){
                $imageName = $r->slug.'.'.$r->image->getClientOriginalExtension();
                $r->image->storeAs('images/categories' , $imageName);
            }else{
                $imageName = 'category.png';
            }
            //Upload to DB
            $CategoryData = $r->all();
            $CategoryData['image'] = $imageName;
            $NewCat = Category::create($CategoryData);
            return redirect()->route('admin.categories.home')->withSuccess('Category '.$NewCat->title.' Created Successfully');
        }
    }
    //Edit
    public function getEdit($id){
        $Category = Category::findOrFail($id);
        return view('admin.category.edit' , compact('Category'));
    }
    public function postEdit(Request $r , $id){
        $Category = Category::findOrFail($id);
        if($Category !=null){
            $Rules = [
                'title' => 'required|min:5|max:255',
                'image' => 'image',
                'description' => 'required|min:25',
            ];
            $validator = Validator::make($r->all() , $Rules);
            if($validator->fails()){
                return back()->withErrors($validator->errors()->all())->withInput();
            }else{
                //Handle the image upload
                if($r->has('image')){
                    $imageName = $Category->slug.'.'.$r->image->getClientOriginalExtension();
                    $r->image->storeAs('images/categories' , $imageName);
                }else{
                    $imageName = 'category.png';
                }
                //Upload to DB
                $CategoryData = $r->all();
                $CategoryData['image'] = $imageName;
                $Category->update($CategoryData);
                return redirect()->route('admin.categories.home')->withSuccess('Category Updated Successfully');
            }
        }else{
            abort(404);
        }
    }
    //Delete
    public function delete(Request $r){
        Category::findOrFail($r->item_id)->delete();
        return response('Category Deleted');
    }
    //Localize
    public function getLocalize($id){
        $Category = Category::findOrFail($id);
        $SystemLangs = explode(',' , Setting::where('title' , 'languages_list')->first()->value);
        return view('admin.category.localize' , compact('Category' , 'SystemLangs'));
    }
    public function postLocalize(Request $r){
        $Rules = [
            'title_value' => 'required|min:5|max:255',
            'slug_value' => 'required|min:5|max:255',
            'description_value' => 'required|min:25',
            'lang_code' => 'required',
            'category_id' => 'required'
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
            $LocalizedData = Category_local::where('lang_code' , $r->lang_code)->where('category_id' , $r->category_id)->first();
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
                $NewLocalizedData = Category_local::create($r->all());
                $Respone = [
                    'error' => false,
                    'list' => 'Translation Created'
                ];
                return response($Respone);
            }
        }
    }
}
