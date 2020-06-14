<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use App\Banners;
use Image;

class BannersController extends Controller
{
    public function banners()
    {
        $banners = Banners::get();
    	return view('admin.banners.banners',compact('banners'));
    }

    public function addBanner(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$request->validate([
	             'name'       => 'required',
                 'link'       => 'required',
                 'sort_order' => 'required',
	             'content'    => 'required',
	             'text_style' => 'required',
	             'image'    => 'required|image|mimes:jpeg,jpg,png|max:3000'
	        ]);
    		$data = $request->all();
            $banner = new Banners;
            $banner->name = $data['name'];
            $banner->text_style = $data['text_style'];
            $banner->link = $data['link'];
            $banner->sort_order = $data['sort_order'];
            $banner->content = $data['content'];
            if($request->hasFile('image'))
            {
                $imageName = rand(1,1000000).Str::slug($data['name']).'.'.$request->image->getClientOriginalExtension();
	            $image_path = 'uploads/banners/'.$imageName;
	                Image::make($request->image)->resize(1920,1001)->save($image_path);
	            $banner->image = $imageName;
            }
            $banner->save();
            toastr()->success('Banner əlavə edildi');
            return redirect('/admin/banners');
    	}
    	return view('admin.banners.add_banner');
    }

    public function editBanner(Request $request,$id=null)
    {
       if($request->isMethod('post'))
       {
          $data = $request->all();
          $request->validate([
                 'name'       => 'required',
                 'text_style' => 'required',
                 'link'       => 'required',
                 'content'    => 'required',
                 'image'      => 'image|mimes:jpeg,jpg,png|max:3000'
          ]);
          if($request->hasFile('image'))
          {
             $banner = Banners::find($id);
             if(File::exists('uploads/banners/'.$banner->image))
             {
                File::delete(public_path('uploads/banners/'.$banner->image));
             }
             $imageName = rand(1,1000000).Str::slug($data['name']).'.'.$request->image->getClientOriginalExtension();
             $image_path = 'uploads/banners/'.$imageName;
                    Image::make($request->image)->resize(1920,1001)->save($image_path);
             $banner->image = $imageName;
          }
          else
          {
              $imageName = $data['current_image'];
          }
          Banners::where(['id'=>$id])->update(['name'=>$data['name'],'text_style'=>$data['text_style'],'sort_order'=>$data['sort_order'],'content'=>$data['content'],'link'=>$data['link'],'image'=>$imageName,'status'=>$data['status']]);
          toastr()->success('Banner redaktə edildi');
          return redirect('/admin/banners');
        }
        $bannerDetails = Banners::where(['id'=>$id])->first();
        return view('admin.banners.edit_banner',compact('bannerDetails'));
    }

    public function deleteBanner($id)
    {
      $banner = Banners::find($id);
      if(File::exists('uploads/banners/'.$banner->image))
      {
         File::delete(public_path('uploads/banners/'.$banner->image));
      }
      $banner->delete();
      //Products::where(['id'=>$id])->delete();
      //Alert::success('Seçilən məhsul silindi');
      toastr()->success('Seçilən banner silindi');
      return redirect()->back();
    }

    public function updateStatus(Request $request, $id=null)
    {
       $data = $request->all();
       Banners::where('id',$data['id'])->update(['status'=>$data['status']]);
    }
}
