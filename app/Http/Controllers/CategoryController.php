<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Category;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    { 
    	if($request->isMethod('post'))
    	{
    		$request->validate([
	             'category_name'    => 'required',
	             'url'              => 'required',
	             'description'      => 'required'
	        ]);
    		$data = $request->all();
    		$category = new Category;       
			$category->category_name = $data['category_name'];
		    $category->parent_id = $data['parent_id'];
		    $category->url = Str::slug($data['url']);
		    $category->description = $data['description'];
		    $category->save();
		    toastr()->success('Kateqoriya əlavə edildi');
		    return redirect('/admin/view-categories');
    	}
    	$levels = Category::where(['parent_id'=>0])->get();
    	return view('admin.categories.add_category',compact('levels'));
    }

    public function viewCategories()
    {
       $categories = Category::get();
       return view('admin.categories.view_categories',compact('categories'));
    }

    public function editCategory(Request $request,$id=null)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            Category::where(['id'=>$id])->update(['category_name'=>$data['category_name'],'parent_id'=>$data['parent_id'],'description'=>$data['description'],'url'=>$data['url'],'status'=>$data['status']]);
            toastr()->success('Kateqoriya redaktə edildi');
            return redirect('/admin/view-categories');
        }
        $levels = Category::where(['parent_id'=>0])->get();
        $categoryDetails = Category::where(['id'=>$id])->first();
        return view('admin.categories.edit_category',compact('levels','categoryDetails'));
    }

    public function deleteCategory($id)
    {
        Category::where(['id'=>$id])->delete();
        toastr()->success('Kateqoriya silindi');
        return redirect()->back();
    }

    public function updateStatus(Request $request, $id=null)
    {
       $data = $request->all();
       Category::where('id',$data['id'])->update(['status'=>$data['status']]);
    }
}
