<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
{
	public function index()
    {
        return view('Admin.category.list');
    }

    public function create()
    {
    	$parent_cats = Category::where('parent', 0)->get();
    	return view('Admin.category.create', ['parent_cats' => $parent_cats]);
    }

    public function save(Request $request)
    {
    	//dd($request);
    	$category = new Category();
    	if($request->parent_cat == -1)
    	{
    		$category->parent = 0;
    	}
    	else $category->parent = $request->parent_cat;
    	$category->name = $request->name;
    	$category->save();
    	return redirect(route('admin.category.index'))->with('success', __('messages.Create Success'));
    }

    public function table(Request $request)
    {
    	$limit = 5;
    	if(isset($_GET['limit'])) $limit = $_GET['limit'];

    	$cats = Category::paginate($limit);
        return view('Admin.category.table', array('cats' => $cats));
    	
    }
}
