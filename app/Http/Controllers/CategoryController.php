<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function allCat()
    {
        /**Method 1: by Elequent ORM*/
        /*$categories = Category::all();*/ //To get data from first add to latest
        //$categories = Category::latest()->get();//To get data from last add to first
        $categories = Category::latest()->paginate(3); // With paging and it is working with join table and delete category
        /**Method 2: by Query builder*/
        //$categories = DB::table('categories')->latest()->get(); //-->Without paging
        //$categories = DB::table('categories')->latest()->paginate(3); // >With paging //and it is not working with join table
        /**Improve Join table with query builder*/ /*It is not work with Delete*/
       /* $categories = DB::table('categories')
            ->join('users', 'categories.user_id', 'users.id')
            ->select('categories.*', 'users.name')
            ->latest()->paginate(3);*/

        /**Get all categories that have been trashed*/
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);
        return view('admin.categories.index', compact('categories','trashCat'));
    }

    public function addCat(Request $request)
    {
        //This can show default error message
        /*$validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);*/
        //his can show custom error message
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
            [
                'category_name.required' => 'Please Input Category Name!',
                'category_name.max' => 'Max Length 255Chars!',
            ]);

        //Here three ways to insert the data for the category
        /**Method 1 Eloquent ROM*/
        /*Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);*/
        /**Method 2 Eloquent ROM*/
        /*$category = new Category();
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->created_at = Carbon::now();
        $category->save();*/

        /**Method 3 Query Builder*/
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();
        DB::table('categories')->insert($data);
        return Redirect()->back()->with('success', 'Successfully Add Category');
    }

    public function editCat($id)
    {
        /**Using ORM Method*/
        /*$categories = Category::find($id);*/
        /**Using Query builder*/
        $categories = DB::table('categories')->where('id', $id)->first();

        return view('admin.categories.edit', compact('categories'));
    }

    public function updateCat(Request $request, $id)
    {
        /**Using ORM Method*/
        /*$update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
        ]);*/
        /**Using Query builder*/
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id', $id)->update($data);
        return Redirect()->route('all.categories')->with('successUpdate', 'Successfully Update Category');
    }

    public function deleteCat($id)
    {
        $delete = Category::find($id)->delete();
        return Redirect::back()->with('successUpdate','Successfully Delete Category');
    }

    public function forceDeleteCat($id)
    {
        $forceDelete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect::back()->with('successUpdate','Successfully Soft Delete Category');
    }

    public function restoreCat($id)
    {
        $restore = Category::withTrashed()->find($id)->restore();
        return Redirect::back()->with('successUpdate','Successfully Force Restore Category');
    }
}
