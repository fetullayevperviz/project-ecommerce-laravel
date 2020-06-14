<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\User;
use App\Countries;

class UsersController extends Controller
{
    public function userLoginRegister()
    {
    	return view("shop.users.login_register");
    }

    public function userRegister(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$data = $request->all();
    		$request->validate([
	             'name'     => 'required',
                 'email'    => 'required|email',
                 'password' => 'required'
	        ]);
    		$userCount = User::where('email',$data['email'])->count();
            if($userCount>0)
            {
            	alert()->error("Bu email artıq qeydiyyatda mövcuddur!");
            	return redirect()->back();
            }
            else
            {
            	$user = new User;
            	$user->name = $data['name'];
            	$user->email = $data['email'];
            	$user->password = bcrypt($data['password']);
            	$user->save();
            	if(Auth::attempt(["email"=>$data["email"],"password"=>$data["password"]]))
            	{
            		Session::put("frontSession",$data["email"]);
            		alert()->success("Təbriklər! Qeydiyyat uğurla tamamlandı.");
            		return redirect("/cart");
            	}
            }
    	}
    }

    public function userLogin(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$data = $request->all();
    		$request->validate([
                 'email'    => 'required',
                 'password' => 'required'
	        ]);
    		if(Auth::attempt(["email"=>$data["email"],"password"=>$data["password"]]))
    		{
    		   Session::put("frontSession",$data["email"]);
               alert()->success("Giriş uğurla tamamlandı");
               return redirect("/cart");
    		}
    		else
    		{
    			alert()->error("Email və ya şifrə doğru deyil");
    			return redirect()->back();
    		}
    	}
    }

    public function userAccount(Request $request)
    {
      return view("shop.users.user_account");
    }

    public function userLogout()
    {
    	Session::forget("frontSession");
    	Auth::logout();
    	alert()->success("Hesabdan çıxış edildi");
    	return redirect("/");
    }

    public function changePassword(Request $request)
    {
        if($request->isMethod("post"))
        {
            $data = $request->all();
            $request->validate([
                 'current_password' => 'required',
                 'new_password' => 'required'
            ]);
            $old_password = User::where("id",Auth::User()->id)->first();
            $current_password = $data["current_password"];
            if(Hash::check($current_password,$old_password->password))
            {
                $new_password = bcrypt($data["new_password"]);
                User::where('id',Auth::User()->id)->update(["password"=>$new_password]);
                alert()->success("Şifrə dəyişdirildi");
                return redirect()->back();
            }
            else
            {
              alert()->error("Yazdığınız köhnə şifrə doğru deyil..Zəhmət olmasa yoxlayıb təkrar cəhd edin");
              return redirect()->back();
            }
        }
        return view("shop.users.change_password");
    }

    public function changeAddress(Request $request)
    {
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $user = User::find($user_id);
            $user->name = $data["name"];
            $user->address = $data["address"];
            $user->city = $data["city"];
            $user->state = $data["state"];
            $user->country = $data["country"];
            $user->pincode = $data["pincode"];
            $user->mobile = $data["mobile"];
            $user->save();
            alert()->success("Hesabınız uğurla redaktə edildi");
            return redirect()->back();
        }
        $countries = Countries::get();
        return view("shop.users.change_address",compact("countries","userDetails"));
    }
}
