<?php
namespace App\Http\Controllers;
//Packages
use Illuminate\Http\Request;
use Validator;
use Auth;
use Hash;
use Mail;
use Socialite;
use Maatwebsite\Excel\Facades\Excel;
//Models
use App\User;
use App\Order;
use App\Mail\WelcomeNewUser;
use App\Mail\WelcomeSocialLogin;
use App\Mail\ResetPasswordMail;
use App\Imports\UsersImport;
use App\Imports\ProductsImport;
class UsersController extends Controller{
    public function test(){
      // Excel::import(new UsersImport, 'users.xlsx');
      Excel::import(new ProductsImport, 'products.xlsx');
      dd("Import Done");
    }
    /*======================= Handmade Signup*/
    public function getSignup(){
      //Get the signup page
      return view('users.signup');
    }
    public function postSignup(Request $r){
      //Validate the Request
      $Rules = [
        'first_name' => 'required|min:4|max:50',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:7',
        'password' => 'min:6|required_with:password-conf|same:password-conf'
      ];
      $ErrorMessages = [
        'first_name.required' => 'Your name is required',
        'first_name.min' => 'Your name can\'t be less than 4 letters',
        'first_name.max' => 'Your name can\'t be longer than 50 letters',
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
                return back()->withErrors('These info don\'t match our records !')->withInput();
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
          'first_name' => $user->name ,
          'email' => $user->email,
          'image' => $ProfileImage,
          'password' => 'PlaceholderPass',
          'auth_provider' => $driver,
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
  //Reset Password
  public function getResetPassword(){
    return view('users.reset');
  }
  public function postResetPassword(Request $r){
    //Filter the request
    $Rules = [
      'email' => 'required|email'
    ];
    $validator = Validator::make($r->all() , $Rules);
    if($validator->fails()){
      return back()->withErrors($validator->errors()->all());
    }else{
      //Get the account if exists
      $TheUser = User::where('email' , $r->email)->first();
      if($TheUser != null){
        //Get the code and send it
        Mail::to($TheUser->email)->send(new ResetPasswordMail($TheUser));
        return back()->withSuccess('If the email exists , You will recive an email from us shortly');
      }else{
        //Do Nothing Basically ...
        return back()->withSuccess('If the email exists , You will recive an email from us shortly');
      }
    }
  }
  public function getSetPassword($id){
    $TheUser = User::findOrFail($id);
    if($TheUser->code == auth()->user()->code){
      $UserId =  $TheUser->id;
      return view('users.set-password' , compact('UserId'));
    }else{
      abort(403);
    }
  }
  public function postSetPassword(Request $r , $id){
    //Validation
    $Rules = [
      'password' => 'required|min:5|confirmed',
    ];
    $validator = Validator::make($r->all(),$Rules);
    if($validator->fails()){
      return back()->withErrors($validator->errors()->all());
    }else{
      $TheUser = User::findOrFail($id);
      $TheUser->update([
        'password' => Hash::make($r->password),
      ]);
      return redirect()->route('home')->withSuccess('Your Password Has Been Updated');
    }
  }
  public function resetFinalStep($code){
    $TheUser = User::where('code' , $code)->first();
    if($TheUser != null){
      return view('users.reset-final' , compact('code'));
      //There is a User with this code
    }else{
      abort(404);
    }
  }
  public function postResetFinalStep(Request $r , $code){
    //Validate the request
    $Rules = [
      'email' => 'required|email',
      'password' => 'required|min:7',
      'password' => 'min:6|required_with:password_conf|same:password_conf'
    ];
    $validator = Validator::make($r->all() , $Rules);
    if($validator->fails()){
      return back()->withErrors($validator->errors()->all());
    }else{
      //Actually Reset the password
      //Get the user by the email and compare the code
      $TheUser = User::where('email' , $r->email)->first();
      if($TheUser->code == $code){
        //Life is good, keep going
        $TheUser->update(['password' => Hash::make($r->password)]);
        Auth::loginUsingId($TheUser->id);
        return redirect()->route('home')->withSuccess('Your Password Has Been Changed !');
      }else{
        return back()->withErrors('Please use your registered account email');
      }
    }
  }
  //Profile Part
  public function getProfile(){
    if(auth()->check()){
      //Continue ...
      //Grab the User Orders if Any
      $UserOrders = Order::where('user_id' , auth()->user()->id)->get();
      $TheUser = auth()->user();
      return view('users.profile' , compact('TheUser','UserOrders'));
    }else{
      abort(403);
    }
  }
  public function updateProfile(Request $r){
     //Validate the Request
     $Rules = [
      'first_name' => 'required|min:4|max:50',
      'email' => 'required|email',
      'image' => 'nullable|image|max:5128',
      'password' => 'required_with:password_current'
    ];
    if($r->email != auth()->user()->email){
      $Rules['email'] = 'required|email|unique:users';
    }
    $ErrorMessages = [
      'first_name.required' => 'Your name is required',
      'first_name.min' => 'Your name can\'t be less than 4 letters',
      'first_name.max' => 'Your name can\'t be longer than 50 letters',
      'email.required' => 'Your email is required',
      'email.required' => 'Your email is required',
      'email.email' => 'Your email is invalid',
      'email.unique' => 'This email is already taken',
      'image.image' => 'This image file is invalid',
      'image.max' => 'The image is too large , 5 MB is the Maximum amount',
      'password.required' => 'The password is required',
      'password.min' => 'The password can\'t be less than 7 letters',
      'password.same' => 'Password confirmation doesn\'t match',
    ];
    $validator = Validator::make($r->all() , $Rules , $ErrorMessages);
    if($validator->fails()){
      return back()->withErrors($validator->errors()->all());
    }else{
      //Check if the logged in use is the same user
      if(auth()->user()->id == $r->id){
        //The Current Data
        $TheUser = User::findOrFail($r->id);
        //Update the data
        $UserData = $r->except(['image' , 'password_current' , 'password']);
        if($r->has('image')){
          //Handle the user image
          $UserData['image'] = $r->id.'.'.$r->image->getClientOriginalExtension();
          $r->image->storeAs('images/users' , $UserData['image']);
        }
        if($r->password_current != null && $r->password != null){
          //Validate the Passwords #The Current Pass is the same ?
          if(Hash::check($r->password_current,$TheUser->password)){
            //The Current Pass is True , Update the password
            $UserData['password'] = Hash::make($r->password);
          }else{
            return back()->withErrors("Current Password is not correct");
          }
        }
        $TheUser->update($UserData);
        return back()->withSuccess('Your Info Has Been Updated');
      }else{
        abort(403);
      }

    }
  }
  public function sendActivateEmail(Request $r){
    $TheUser = User::findOrFail($r->id);
    if(!$TheUser->confirmed){
      //Send The Email
      Mail::to($TheUser->email)->send(new WelcomeNewUser($TheUser));
      return "We Sent You Activation Email !";
    }else{
      return "Your Account is Active";
    }
  }
  public function activateAccount($code){
    //Chech if the code exists
    $TheUser = User::where('code' , $code)->first();
    if($TheUser != null){
      //Activate the user
      if($TheUser->confirmed){
        $OldState = "Confirmed";
        $CurrentState = "Confirmed";
        return view('users.activate' , compact('OldState' , 'CurrentState'));
      }else{
        $TheUser->confirmed = 1;
        $TheUser->save();
        $OldState = "NotConfirmed";
        $CurrentState = "Confirmed";
        return view('users.activate' , compact('OldState' , 'CurrentState'));
      }
    }else{
      abort(404);
    }
  }
  public function getWishlist(){
    $TheUser = auth()->user();
    return view('users.wishlist' , compact('TheUser'));
  }
  public function getOrdersList(){
    if(auth()->check()){
      $TheUser = auth()->user();
      return view('users.user-orders' , compact('TheUser'));
    }else{
      abort(403);
    }
  }
  //Admin Panel Stuff
  public function getHome(){
    $Users = User::latest()->get();
    return view('admin.user.index' , compact('Users'));
  }
  public function delete(Request $r){
    $User = User::findOrFail($r->item_id)->delete();
    return response("User Deleted Successfully");
  }
  public function ToggleActive(Request $r){
    $User = User::findOrFail($r->item_id)->first();
    $User->confirmed = !$User->confirmed;
    $User->save();
    if($User->confirmed == 1){
      return response([
        'successMessage' => 'User Activated',
        'btnMessage' => 'Deactivate'
      ]);
    }else{
      return response([
        'successMessage' => 'User Deactivated',
        'btnMessage' => 'Activate'
      ]);
    }
  }




}
