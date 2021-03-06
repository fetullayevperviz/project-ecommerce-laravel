<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function login(Request $request)
    {
    	if($request->isMethod('post'))
    	{
            $data = $request->all();
    		if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>1]))
    		{
                toastr()->success('Xoş gəldiniz! '.Auth::user()->name);
    			return redirect('/admin/dashboard');
    		}
    		else
    		{
    			return redirect('/admin')->with('flash_message_error','Email və ya Şifrə doğru deyil');
    		}
    	}
    	return view('admin.admin_login');
    }

    public function dashboard()
    {
    	return view('admin.dashboard');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/admin')->with('flash_message_success','Çıxış edildi!');
    }
}
