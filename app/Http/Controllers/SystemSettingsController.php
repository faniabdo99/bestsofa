<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
//Models
use App\Setting;
class SystemSettingsController extends Controller{
    //Get the index of system settings
    public function getHome(){
        $SystemSettings = Setting::latest()->get();
        return view('admin.system.index' , compact('SystemSettings'));
    }
    //Get edit page
    public function getEdit($id){
        $SystemSettings = Setting::findOrFail($id);
        return view('admin.system.edit' , compact('SystemSettings'));
    }
    //Post update page 
    public function postEdit(Request $r , $id){
        //Validation
        $Rules = [
            'value' => 'required'
        ];
        $validator = Validator::make($r->all() , $Rules);
        if($validator->fails()){
            return back()->withErrors($validator->errors()->all());
        }else{
            $SystemSettings = Setting::find($id)->update($r->all());
            return redirect()->route('admin.system.home');
        }
    }
}
