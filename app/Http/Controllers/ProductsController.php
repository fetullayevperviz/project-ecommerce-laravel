<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Products;
use App\Category;
use App\Coupons;
use App\ProductAttributes;
use App\ProductImages;
use App\User;
use App\Countries;
use App\DeliveryAddress;
use App\Orders;
use App\OrdersProduct;
use Image;

class ProductsController extends Controller
{
    public function addProduct(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$request->validate([
	             'product_name'    => 'required',
               'gender'          => 'required',
               'chapter'         => 'required',
	             'product_code'    => 'required',
	             'product_color'   => 'required',
               'category_id'     => 'required',
	             'product_description' => 'required',
	             'product_price' => 'required',
	             'image'    => 'required|image|mimes:jpeg,jpg,png|max:3000'
	        ]);
  		    $data = $request->all();
  		    $product = new Products;
  		    $product->product_name  = $data['product_name'];
          $product->category_id = $data['category_id'];
  		    $product->product_code  = $data['product_code'];
  		    $product->product_color = $data['product_color'];
          $product->gender = $data['gender'];
          $product->chapter = $data['chapter'];
          if(!empty($data['product_description']))
          {
          	$product->product_description = $data['product_description'];
          }
          else
          {
          	$product->product_description = '';
          }
          $product->product_price = $data['product_price'];
          if($request->hasFile('image'))
          {
              $imageName = rand(1,1000000).Str::slug($data['product_name']).'.'.$request->image->getClientOriginalExtension();
            $image_path = 'uploads/product/'.$imageName;
                Image::make($request->image)->resize(500,500)->save($image_path);
            $product->image = $imageName;
          }
          $product->save();
          toastr()->success('Məhsul əlavə edildi');
          return redirect('/admin/view-products');
    	}
      //Categories dropdown menu code
      $categories = Category::where(['parent_id'=>0])->get();
      $categories_dropdown = "<option value='' selected disabled>Seçin</option>";
      foreach ($categories as $cat) 
      {
          $categories_dropdown .= "<option value='".$cat->id."'>".$cat->category_name."</option>";
          $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
          foreach ($sub_categories as $sub_cat) 
          {
              $categories_dropdown .= "<option value='".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->category_name."</option>";
          }
      }
    	return view('admin.products.add_product',compact('categories_dropdown'));
    }

    public function viewProducts()
    {
    	$products = Products::get();
    	return view('admin.products.view_products',compact('products'));
    }

    public function editProduct(Request $request,$id=null)
    {
       if($request->isMethod('post'))
       {
       	  $data = $request->all();
       	  $request->validate([
	             'image'    => 'image|mimes:jpeg,jpg,png|max:3000'
	      ]);
       	  if($request->hasFile('image'))
	      {
	      	 $product = Products::find($id);
             if(File::exists('uploads/product/'.$product->image))
             {
                File::delete(public_path('uploads/product/'.$product->image));
             }
	         $imageName = rand(1,1000000).Str::slug($data['product_name']).'.'.$request->image->getClientOriginalExtension();
	         $image_path = 'uploads/product/'.$imageName;
	                Image::make($request->image)->resize(500,500)->save($image_path);
	         $product->image = $imageName;
	      }
	      else
	      {
	      	  $imageName = $data['current_image'];
	      }
	      if($data['product_description'])
	      {
	       	  $data['product_description'] = '';
	      }
	      Products::where(['id'=>$id])->update(['product_name'=>$data['product_name'],'category_id'=>$data['category_id'],'gender'=>$data['gender'],'chapter'=>$data['chapter'],'product_code'=>$data['product_code'],'product_color'=>$data['product_color'],'product_price'=>$data['product_price'],'image'=>$imageName,'status'=>$data['status']]);
	      toastr()->success('Məhsul redaktə edildi');
	      return redirect('/admin/view-products');
	    }
	        $productDetails = Products::where(['id'=>$id])->first();
          //Category dropdown code
          $categories = Category::where(['parent_id'=>0])->get();
          $categories_dropdown = "<option value='' selected disabled>Seçin</option>";
          foreach ($categories as $cat) 
          {
             if($cat->id==$productDetails->category_id)
             {
                $selected = "selected";
             }
             else
             {
                $selected = "";
             }
             $categories_dropdown .= "<option value='".$cat->id."' ".$selected.">".$cat->category_name."</option>";
          //Sub category code

          $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
          foreach ($sub_categories as $sub_cat) 
          {
             if($sub_cat->id==$productDetails->category_id)
             {
                $selected = "selected";
             }
             else
             {
                $selected = "";
             }
             $categories_dropdown .= "<option value='".$sub_cat->id."' ".$selected.">&nbsp;--&nbsp;".$sub_cat->category_name."</option>";
          }
        }
	      return view('admin.products.edit_product',compact('productDetails','categories_dropdown'));
	  }

  	public function deleteProduct($id)
  	{
  		$product = Products::find($id);
      if(File::exists('uploads/product/'.$product->image))
      {
         File::delete(public_path('uploads/product/'.$product->image));
      }
      $product->delete();
  		//Products::where(['id'=>$id])->delete();
  		//Alert::success('Seçilən məhsul silindi');
  		toastr()->success('Seçilən məhsul silindi');
  		return redirect()->back();
  	}

    public function updateStatus(Request $request, $id=null)
    {
       $data = $request->all();
       Products::where('id',$data['id'])->update(['status'=>$data['status']]);
    }

    public function products($id=null)
    {
       $productDetails = Products::with('attributes')->where(['id'=>$id])->first();
       $productAltImages = ProductImages::where('product_id',$id)->get();
       $featuredProducts = Products::where(['featured_products'=>1])->get();
       return view('shop.product_details',compact('productDetails','productAltImages','featuredProducts'));
    }

    public function addAttributes(Request $request,$id=null)
    {
       $productDetails = Products::with('attributes')->where(['id'=>$id])->first();
       if($request->isMethod('post'))
       {
          $data = $request->all();
          foreach ($data['sku'] as $key => $val) 
          {
              if(!empty($val))
              {
                 //prevent duplicate SKU record
                 $attrCountSKU = ProductAttributes::where('sku',$val)->count();
                 if($attrCountSKU>0)
                 {
                    alert()->error('Bu adda atribut artıq mövcuddur, zəhmət olmasa başqa bir atribut adı yazın');
                    return redirect('/admin/add-attributes/'.$id);
                 }
                 //prevent duplicate Size record
                 $attrCountSizes = ProductAttributes::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                 if($attrCountSizes>0)
                 {
                    alert()->error("Bu ölçü artıq mövcuddur, zəhmət olmasa başqa bir ölçü daxil edin");
                    return redirect('/admin/add-attributes/'.$id);
                 }
                 //prevent duplicate Price record
                 $attrCountSKU = ProductAttributes::where('sku',$val)->count();
                 if($attrCountSKU>0)
                 {
                    alert()->error('Bu adda atribut artıq mövcuddur, zəhmət olmasa başqa bir atribut adı yazın');
                    return redirect('/admin/add-attributes/'.$id);
                 }
                 $attribute = new ProductAttributes;
                 $attribute->product_id = $id;
                 $attribute->sku   = $val;
                 $attribute->size  = $data['size'][$key];
                 $attribute->price = $data['price'][$key];
                 $attribute->stock = $data['stock'][$key];
                 $attribute->save();
              }
          }
          alert()->success('Atributlar əlavə edildi');
          return redirect('/admin/add-attributes/'.$id);
       }
       return view('admin.products.add_attributes',compact('productDetails'));
    }

    public function deleteAttribute($id=null)
    {
       ProductAttributes::where(['id'=>$id])->delete();
       alert()->success('Atribut silindi');
       return redirect()->back();
    }

    public function editAttributes(Request $request,$id=null)
    {
       if($request->isMethod('post'))
       {
          $data = $request->all();
          foreach ($data['attr'] as $key => $attr) 
          {
             ProductAttributes::where(['id'=>$data['attr'][$key]])->update(['sku'=>$data['sku'][$key],'size'=>$data['size'][$key],'price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
          }
          alert()->success('Atributlar redaktə edildi');
          return redirect()->back();
       }
    }

    public function addImages(Request $request,$id=null)
    {
       $productDetails = Products::where(['id'=>$id])->first();
       if($request->isMethod('post'))
       {
          $data = $request->all();
          if($request->hasFile('image'))
          {
             $files = $request->file('image');
             foreach ($files as $file) 
             {
                $image = new ProductImages;
                $extension = $file->getClientOriginalExtension();
                $filename = rand(1,1000000).'.'.$extension;
                $image_path = 'uploads/product/'.$filename;
                Image::make($file)->resize(500,500)->save($image_path);
                $image->image = $filename;
                $image->product_id = $data['product_id'];
                $image->save();
             }
          }
          alert()->success('Şəkil əlavə edildi');
          return redirect('/admin/add-images/'.$id);
       }
       $productImages = ProductImages::where(['product_id'=>$id])->get();
       return view('admin.products.add_images',compact('productDetails','productImages'));
    }

    public function deleteAltImage($id=null)
    {
       $productImage = ProductImages::where(['id'=>$id])->first();
       if(File::exists('uploads/product/'.$productImage->image))
       {
         File::delete(public_path('uploads/product/'.$productImage->image));
       }
       ProductImages::where(['id'=>$id])->delete();
       alert()->success('Seçilən şəkil silindi');
       return redirect()->back();
    }

    public function updateFeaturedStatus(Request $request,$id=null)
    {
       $data = $request->all();
       Products::where('id',$data['id'])->update(['featured_products'=>$data['status']]);
    }

    public function getPrice(Request $request)
    {
       $data = $request->all();
       $proArr = explode("-", $data['idSize']);
       $proAttr = ProductAttributes::where(['product_id'=>$proArr[0],'size'=>$proArr[1]])->first();
       echo $proAttr->price;
    }

    public function addToCart(Request $request)
    {
       Session::forget("CouponAmount");
       Session::forget("CouponCode");
       $data = $request->all();
       if(empty(Auth::user()->email))
       {
          $data["user_email"] = "";
       }
       else
       {
          $data["user_email"] = Auth::user()->email;
       }
       $session_id = Session::get('session_id');
       if(empty($session_id))
       {
          $session_id = Str::random(40);
          Session::put('session_id',$session_id);
       }
       $sizeArr = explode('-', $data['size']);
       $countProduct = DB::table('carts')->where(['product_id'=>$data['product_id'],'product_color'=>$data['product_color'],'price'=>$data['product_price'],'size'=>$sizeArr[1],'session_id'=>$session_id])->count();
       if($countProduct>0)
       {
          toastr()->error("Bu məhsul artıq səbətdə mövcuddur!");
       }
       else
       {
         DB::table('carts')->insert(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],'product_color'=>$data['product_color'],'product_code'=>$data['product_code'],
        'price'=>$data['product_price'],'size'=>$sizeArr[1],'quantity'=>$data['quantity'],'user_email'=>$data['user_email'],'session_id'=>$session_id]);
         toastr()->success('Məhsul səbətə əlavə edildi');
       }     
       return redirect("/cart");
    }

    public function cart(Request $request)
    {
       if(Auth::check())
       {
          $user_email = Auth::user()->email;
          $userCart = DB::table("carts")->where(["user_email"=>$user_email])->get();
       }
       else
       {
          $session_id = Session::get('session_id');
          $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
       }
       foreach ($userCart as $key => $products) 
       {
          $productDetails = Products::where(['id'=>$products->product_id])->first();
          $userCart[$key]->image = $productDetails->image;
       }
       return view('shop.products.cart',compact('userCart'));
    }

    public function deleteCartProduct($id=null)
    {
       Session::forget("CouponAmount");
       Session::forget("CouponCode");
       DB::table("carts")->where("id",$id)->delete();
       toastr()->success("Məhsul səbətdən silindi");
       return redirect("/cart");
    }

    public function updateCartQuantity($id=null,$quantity=null)
    {
       Session::forget("CouponAmount");
       Session::forget("CouponCode");
       DB::table("carts")->where('id',$id)->increment('quantity',$quantity);
       toastr()->success("Səbətdə məhsul sayı redaktə edildi");
       return redirect('/cart');
    }

    public function applyCoupon(Request $request)
    {
       Session::forget("CouponAmount");
       Session::forget("CouponCode");
       if($request->isMethod('post'))
       {
          $data = $request->all();
          $couponCount = Coupons::where('coupon_code',$data['coupon_code'])->count();
          if($couponCount == 0)
          {
             toastr()->error("Yazdığınız kupon kodu doğru deyil");
             return redirect()->back();
          }
          else
          {
             $couponDetails = Coupons::where('coupon_code',$data['coupon_code'])->first();
             //Coupon code status
             if($couponDetails->status==0)
             {
               toastr()->error("Bu kupon kodu aktiv deyil");
               return redirect()->back();
             }
             //check coupon expiry_date
             $expiry_date = $couponDetails->expiry_date;
             $current_date = date("Y-m-d");
             if($expiry_date < $current_date)
             {
                toastr()->error("Bu kuponun istifade müddəti artıq bitib");
                return redirect()->back();
             }
             //coupon is ready for discount
             $session_id = Session::get('session_id');
             //$userCart = DB::table("carts")->where(["session_id"=>$session_id])->get();
             if(Auth::check())
             {
                $user_email = Auth::user()->email;
                $userCart = DB::table("carts")->where(["user_email"=>$user_email])->get();
             }
             else
             {
                $session_id = Session::get('session_id');
                $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
             }
             $total_amount = 0;
             foreach ($userCart as $item) 
             {
                $total_amount = $total_amount + ($item->price*$item->quantity);
             }
             //check of coupon amount is Sabit or Faiz
             if($couponDetails->amount_type=="Sabit")
             {
                $couponAmount = $couponDetails->amount;
             }
             else
             {
                $couponAmount = $total_amount *($couponDetails->amount/100);
             }
             //Add coupon code in session
             Session::put("CouponAmount",$couponAmount);
             Session::put("CouponCode",$data["coupon_code"]);
             toastr()->success("Kupon uğurla tətbiq edildi");
             return redirect()->back();
          }
       }
    }

    public function checkout(Request $request)
    {     
       $user_id = Auth::user()->id;
       $user_email = Auth::user()->email;
       $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
       $userDetails = User::find($user_id);
       $countries = Countries::get();
       $shippingCount = DeliveryAddress::where("user_id",$user_id)->count();
       $shippingDetails = array();
       if($shippingCount > 0)
       {
           $shippingDetails = DeliveryAddress::where("user_id",$user_id)->first();
       }

       //$session_id = Session::get("session_id");
       //DB::table("carts")->where(["session_id"=>$session_id])->update(["user_email"=>$user_email]);

       if($request->isMethod('post'))
       {
          $request->validate([
                 'billing_name'     => 'required',
                 'billing_address'  => 'required',
                 'billing_city'     => 'required',
                 'billing_state'    => 'required',
                 'billing_country'  => 'required',
                 'billing_pincode'  => 'required',
                 'billing_mobile'   => 'required',
                 'shipping_name'    => 'required',
                 'shipping_address' => 'required',
                 'shipping_city'    => 'required',
                 'shipping_state'   => 'required',
                 'shipping_country' => 'required',
                 'shipping_pincode' => 'required',
                 'shipping_mobile'  => 'required'
            ]);
          $data = $request->all();
          User::where('id',$user_id)->update(["name"=>$data["billing_name"],"address"=>$data["billing_address"],"city"=>$data["billing_city"],"state"=>$data["billing_state"],"country"=>$data["billing_country"],"mobile"=>$data["billing_mobile"],"pincode"=>$data["billing_pincode"]]);
          if($shippingCount > 0)
          {
              DeliveryAddress::where('user_id',$user_id)->update(["name"=>$data["shipping_name"],"address"=>$data["shipping_address"],"city"=>$data["shipping_city"],"state"=>$data["shipping_state"],"country"=>$data["shipping_country"],"mobile"=>$data["shipping_mobile"],"pincode"=>$data["shipping_pincode"]]);
          }
          else
          {
              $shipping = new DeliveryAddress;
              $shipping->user_id = $user_id;
              $shipping->user_email = $user_email;
              $shipping->name = $data["shipping_name"];
              $shipping->address = $data["shipping_address"];
              $shipping->city = $data["shipping_city"];
              $shipping->state = $data["shipping_state"];
              $shipping->country = $data["shipping_country"];
              $shipping->pincode = $data["shipping_pincode"];
              $shipping->mobile = $data["shipping_mobile"];
              $shipping->save();
          }
          return redirect()->action("ProductsController@orderReview");
       }
       return view("shop.products.checkout",compact('userDetails','countries','shippingDetails'));
    }

    public function orderReview()
    {
       $user_id = Auth::user()->id;
       $user_email = Auth::user()->email;
       $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
       $userDetails = User::find($user_id);
       $userCart = DB::table("carts")->where(["user_email"=>$user_email])->get();
       foreach ($userCart as $key => $product) 
       {
          $productDetails = Products::where('id',$product->product_id)->first();
          $userCart[$key]->image = $productDetails->image;
       }
       return view("shop.products.order_review",compact('userDetails','shippingDetails','userCart'));
    }

    public function placeOrder(Request $request)
    {
       if($request->isMethod('post'))
       {
          $user_id = Auth::user()->id;
          $user_email = Auth::user()->email;
          $data = $request->all();
          $shippingDetails = DeliveryAddress::where(["user_email"=>$user_email])->first();
          
          if(empty(Session::get('CouponCode')))
          {
             $coupon_code = "Kupon tətbiq edilməyib";
          }
          else
          {
             $coupon_code = Session::get('CouponCode');
          }
          if(empty(Session::get('CouponAmount')))
          {
             $coupon_amount = 0;
          }
          else
          {
             $coupon_amount = Session::get('CouponAmount');
          }

          $order = new Orders;
          $order->user_id = $user_id;
          $order->user_email = $user_email;
          $order->name = $shippingDetails->name;
          $order->address = $shippingDetails->address;
          $order->city = $shippingDetails->city;
          $order->state = $shippingDetails->state;
          $order->country = $shippingDetails->country;
          $order->pincode = $shippingDetails->pincode;
          $order->mobile = $shippingDetails->mobile;
          $order->coupon_code = $coupon_code;
          $order->coupon_amount = $coupon_amount;
          $order->order_status = "Yeni";
          $order->payment_method = $data["payment_method"];
          $order->grand_total = $data["grand_total"];
          $order->save();
          
          $order_id = DB::getPdo()->lastinsertID();
          $cartProducts = DB::table("carts")->where(["user_email"=>$user_email])->get();
          foreach ($cartProducts as $product) 
          {
             $cartPro = new OrdersProduct;
             $cartPro->order_id = $order_id;
             $cartPro->user_id = $user_id;
             $cartPro->product_id = $product->product_id;
             $cartPro->product_code = $product->product_code;
             $cartPro->product_name = $product->product_name;
             $cartPro->product_size = $product->size;
             $cartPro->product_color = $product->product_color;
             $cartPro->product_price = $product->price;
             $cartPro->product_quantity = $product->quantity;
             $cartPro->save();
          }
          Session::put('order_id',$order_id);
          Session::put('grand_total',$data["grand_total"]);
          alert()->success("Sifarişiniz qeydə alındı");
          return redirect("/thanks");
       }
    }

    public function thanks()
    {
       $user_email = Auth::user()->email;
       DB::table("carts")->where(["user_email"=>$user_email])->delete();
       return view("shop.orders.thanks");
    }


    public function userOrders()
    {
       $user_id = Auth::user()->id;
       $orders = Orders::with("orders")->where("user_id",$user_id)->orderBy("id","DESC")->get();
       return view("shop.orders.user_orders",compact("orders"));
    }

    public function userOrderDetails($order_id)
    {
       $orderDetails = Orders::with("orders")->where("id",$order_id)->first();
       $user_id = $orderDetails->user_id;
       $userDetails = User::where("id",$user_id)->first();
       return view("shop.orders.user_order_details",compact("orderDetails","userDetails"));
    }

    public function viewOrders()
    {
       $orders = Orders::with("orders")->orderBy("id","DESC")->get();
       return view("admin.orders.view_orders",compact("orders"));
    }
}
