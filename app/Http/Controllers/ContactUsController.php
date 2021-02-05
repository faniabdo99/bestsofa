<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Mail;
use App\Mail\ContactUsMail;
use App\Mail\ContactEmailRecived;
class ContactUsController extends Controller{
    public function getContact(){
      return view('pages.contact');
    }
    public function postContact(Request $r){
      //Validate the request
      $Rules = [
        'name' => 'required|min:4|max:50',
        'email' => 'required|email',
        'phone_number' => 'required',
        'country' => 'required',
        'message' => 'required'
      ];
      $ErrorMessages = [
        'name.required' => __('controllers.contact_validation_name_required'),
        'name.min' => __('controllers.contact_validation_name_min'),
        'name.max' => __('controllers.contact_validation_name_max'),
        'email.required' => __('controllers.contact_validation_email_required'),
        'email.email' => __('controllers.contact_validation_email_email'),
        'phone_number.required' => __('controllers.contact_validation_phone_number_required'),
        'country.required' => __('controllers.contact_validation_country_required'),
        'message.required' => __('controllers.contact_validation_message_required'),
      ];
      $validator = Validator::make($r->all() , $Rules , $ErrorMessages);
      if($validator->fails()){
        return back()->withErrors($validator->errors()->all())->withInput();
      }else{
        //Do the contact
        Mail::to('faniabdo99@gmail.com')->send(New ContactUsMail($r->all()));
        Mail::to($r->email)->send(New ContactEmailRecived($r->all()));
        return back()->withSuccess(__('controllers.contact_message_received'));
      }
    }
}
