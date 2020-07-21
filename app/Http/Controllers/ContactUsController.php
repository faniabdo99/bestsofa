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
        'subject' => 'required',
        'phone_number' => 'required',
        'country' => 'required',
        'message' => 'required'
      ];
      $ErrorMessages = [
        'name.required' => 'Your name is required',
        'name.min' => 'Your name can\'t be less than 4 letters',
        'name.max' => 'Your name can\'t be longer than 50 letters',
        'email.required' => 'Your email is required',
        'email.email' => 'Your email is invalid',
        'subject.required' => 'The Message Subject is Required',
        'phone_number.required' => 'Your Phone Number is Required',
        'country.required' => 'Your Country is Required',
        'message.required' => 'The Message is Required'
      ];
      $validator = Validator::make($r->all() , $Rules , $ErrorMessages);
      if($validator->fails()){
        return back()->withErrors($validator->errors()->all())->withInput();
      }else{
        //Do the contact
        Mail::to('test@admin.com')->send(New ContactUsMail($r->all()));
        Mail::to($r->email)->send(New ContactEmailRecived($r->all()));
        return back()->withSuccess('Your Message Has Been Recived , Thank You!');
      }
    }
}
