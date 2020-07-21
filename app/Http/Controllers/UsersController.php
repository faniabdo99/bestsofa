<?php
namespace App\Http\Controllers;
//Packages
use Illuminate\Http\Request;
use Validator;
use Auth;
use Hash;
use Mail;
use Socialite;
//Models
use App\User;
use App\Mail\WelcomeNewUser;
use App\Mail\WelcomeSocialLogin;
class UsersController extends Controller{
    /*======================= Handmade Signup*/
    public function getSignup(){
      //Get the signup page
      return view('users.signup');
    }
    public function postSignup(Request $r){
      //Validate the Request
      $Rules = [
        'name' => 'required|min:4|max:50',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:7',
        'password' => 'min:6|required_with:password-conf|same:password-conf'
      ];
      $ErrorMessages = [
        'name.required' => 'Your name is required',
        'name.min' => 'Your name can\'t be less than 4 letters',
        'name.max' => 'Your name can\'t be longer than 50 letters',
        'email.required' => 'Your email is required',
        'email.email' => 'Your email is invalid',
        'email.unique' => 'This email is already taken',
        'password.required' => 'The password is required',
        'password.min' => 'The password can\'t be less than 7 letters',
        'password.same' => 'Password confirmation doesn\'t match',
      ];
      $validator = Validator::make($r->all() , $Rules , $ErrorMessages);
      if($validator->fails()){
        return back()->withErrors($validator->errors()->all())->withInput();
      }else{
        //User Data
        $UserData = $r->except('password-conf');
        $UserData['code'] = rand(0,99999999);
        $UserData['password'] = Hash::make($r->password);
        //Create the new user
        $NewUser = User::create($UserData);
        //Log the user in 
        Auth::loginUsingId($NewUser->id);
        //Send Confirmation Email to the user
        Mail::to($r->email)->send(new WelcomeNewUser($UserData));
        return back()->withSuccess('User Has Been Created Successfully');
      }
    }


    /*============================ Handmade Login*/
    public function getLogin(){
      return view('users.login');
    }
    public function postLogin(Request $r){
      //Validate the request
      $Rules = [
        'email' => 'required|email',
        'password' => 'required'
      ];
      $ErrorMessages = [
        'email.required' => 'Your Email is Required',
        'email.email' => 'This Email is invalid',
        'password.required' => 'Your Password is Required'
      ];
      $validator = Validator::make($r->all() , $Rules , $ErrorMessages);
      if($validator->fails()){
        return back()->withErrors($validator->errors()->all())->withInput();
      }else{
        //Login Logic Starts Here
        $KeepLogin = ($r->keep_login == 'on') ? true : false;
        if(auth()->attempt(['email' => $r->email , 'password' => $r->password] , $KeepLogin)){
                 return redirect()->route('home');
         }else{
                return back()->withErrors('These info don\'t match our records !');
          }
      }
    }
    /*================================== Social auth */
    public function redirectToProvider($provider){
      return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback(Request $r , $driver){
      $user = Socialite::driver($driver)->user();
      $FindUser = User::where('email' , $user->email)->get();
      if($FindUser->count() == 0){
        //Signup
        $ProfileImage = (isset($user->avatar)) ? $user->avatar : 'user.png';
        $NewUser = User::create([
          'name' => $user->name ,
          'email' => $user->email,
          'image' => $ProfileImage,
          'password' => 'PlaceholderPass',
          'code' =>  rand(0,99999999),
          'confirmed' => 1
        ]);
        //Send Welcome Email
        Mail::to($NewUser->email)->send(new WelcomeSocialLogin($user));
        auth()->loginUsingId($NewUser->id);
        return redirect()->route('home');
      }else{
        auth()->loginUsingId($FindUser->first()->id);
        return redirect()->route('home');
      }

    }
    /*================================== Handmade Logout*/
    public function logout(){
      auth()->logout();
      return redirect()->route('home');
    }
}
