<?php

namespace App\Http\Controllers\Frontuser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\Country;

use Auth;
use Session;

class UsersController extends Controller
{
    //

    public function userloginregister()
    {
        return view('users.login_register');

    }
    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data);die;
            $userCount = User::where('email',$data['email'])->count();
            if($userCount>0){
                return redirect()->back()->with('err','Email already exists!');
            }else{
                $user = new User;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->phone = $data['phone'];
                $user->password = bcrypt($data['password']);
                $user->save();

                if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                    Session::put('frontSession',$data['email']);
                    return redirect('/cart');
                }
            }
        }
        
    }

    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
           // echo "<pre>";print_r($data);die;
           if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
               Session::put('frontSession',$data['email']);
               return redirect('/cart');
           }else{
               return redirect()->back()->with('err','Invalid Email or password');
           }
        }
    }

    public function logout(){
        Auth::logout();
        Session::forget('frontSession');
        return redirect('/');
    }

    public function account(Request $request)
    {
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
        //echo "<pre>"; print_r($userDetails);die;
        $countries = Country::get();

        if($request->isMethod('post')){
            $data = $request->all();

            if(empty($data['name'])){
            return redirect()->back()->with('err','Please enter your Name to update your account!');
            }
            if(empty($data['address'])){
                return redirect()->back()->with('err','Please enter your Name to update your account!');
            }
            if(empty($data['city'])){
                return redirect()->back()->with('err','Please enter your Name to update your account!');
            }
            if(empty($data['state'])){
                return redirect()->back()->with('err','Please enter your Name to update your account!');
            }
            if(empty($data['country'])){
                return redirect()->back()->with('err','Please enter your Name to update your account!');
            }
            if(empty($data['pincode'])){
                return redirect()->back()->with('err','Please enter your Name to update your account!');
            }
            if(empty($data['phone'])){
                return redirect()->back()->with('err','Please enter your Name to update your account!');
            }

            $user = User::find($user_id);

            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state = $data['state'];
            $user->country = $data['country'];
            $user->pincode = $data['pincode'];
            $user->phone = $data['phone'];

            $user->save();
            return redirect()->back()->with('succ','Your account details has been updated!');

        }
        return view('users.account')->with(compact('countries','userDetails'));

    }
    
    public function chkUserPassword(Request $request){
        $data = $request->all();
        //echo "<pre>"; print_r($data); die;
        $current_password = $data['current_pwd'];
        $user_id = Auth::User()->id;
        $check_password = User::where('id',$user_id)->first();

        if(Hash::check($current_password,$check_password->password)){
            echo "true"; die;
        }else{
            echo "false";die;
        }
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data =$request->all();
            //echo "<pre>"; print_r($data);die;
            $old_pwd = User::where('id',Auth::User()->id)->first();
            $current_pwd = $data['current_pwd'];
            if(Hash::check($current_pwd,$old_pwd->password)){
                $new_pwd = bcrypt($data['new_pwd']);
                User::where('id',Auth::User()->id)->update(['password'=>$new_pwd]);
                return redirect()->back()->with('succ','Password updated successfully');

            }else{
                return redirect()->back()->with('err','Current Password is incorrect');
            }
        }
    }

      
}
