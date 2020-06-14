<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Coupons;

class CouponController extends Controller
{
    public function addCoupon(Request $request)
    {
       if($request->isMethod("post"))
       {
       	  $data = $request->all();
       	  $request->validate([
               'amount'          => 'required',
               'amount_type'     => 'required',
	           'expiry_date'     => 'required'
	      ]);
       	  $coupon = new Coupons;
       	  $coupon_code = Str::random(20);
       	  $coupon->coupon_code = $coupon_code;
       	  $coupon->amount = $data["amount"];
       	  $coupon->amount_type = $data["amount_type"];
       	  $coupon->expiry_date = $data["expiry_date"];
       	  $coupon->save();
       	  toastr()->success("Kupon əlavə edildi");
       	  return redirect("/admin/view-coupons");
       }
       return view("admin.coupons.add_coupon");
    }

    public function viewCoupons()
    {
    	$coupons = Coupons::get();
    	return view("admin.coupons.view_coupons",compact("coupons"));
    }

    public function editCoupon(Request $request,$id=null)
    {
    	if($request->isMethod('post'))
    	{
    		$data = $request->all();
    		$request->validate([
    		   'coupon_code'     => 'required',
               'amount'          => 'required',
               'amount_type'     => 'required',
	           'expiry_date'     => 'required'
	        ]);
    		$coupon = Coupons::find($id);
    		$coupon->coupon_code = $data["coupon_code"];
    		$coupon->amount = $data["amount"];
    		$coupon->amount_type = $data["amount_type"];
    		$coupon->expiry_date = $data["expiry_date"];
    		$coupon->save();
    		toastr()->success("Kupon redaktə edildi");
    		return redirect("/admin/view-coupons");
    	}
    	$couponDetails = Coupons::find($id);
    	return view("admin.coupons.edit_coupon",compact("couponDetails"));
    }

    public function deleteCoupon($id=null)
    {
       Coupons::where(["id"=>$id])->delete();
       toastr()->success("Kupon silindi");
       return redirect()->back();
    }

    public function updateStatus(Request $request, $id=null)
    {
       $data = $request->all();
       Coupons::where('id',$data['id'])->update(['status'=>$data['status']]);
    }
}
