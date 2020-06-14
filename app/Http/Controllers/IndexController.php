<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banners;
use App\Category;
use App\Products;

class IndexController extends Controller
{
    public function index()
    {
    	$banners = Banners::where('status',1)->orderBy('sort_order','DESC')->get();
    	$categories = Category::with('categories')->where(['parent_id'=>0])->where('status',1)->get();
      $products = Products::where('status',1)->paginate(12);
    	return view('shop.index',compact('banners','categories','products'));
    }

    public function categories($category_id,$url)
    {
       $categories = Category::with('categories')->where(['parent_id'=>0])->where('status',1)->get();
       $products = Products::where(['category_id'=>$category_id])->where('status',1)->get();
       $product_name = Products::where(['category_id'=>$category_id])->first();
       return view('shop.category',compact('categories','products','product_name'));
    }

    public function home()
    {
        $banners = Banners::where('status',1)->orderBy('sort_order','DESC')->get();
        $categories = Category::with('categories')->where(['parent_id'=>0])->where('status',1)->get();
        $products = Products::where('status',1)->paginate(12);
        return view("shop.index",compact("banners","categories","products"));
    }
}
