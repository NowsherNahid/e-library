<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $counter = 1;
        $categories = Category::orderBy('id','DESC')->get();
        return view('categories',compact('categories','counter'));
    }

    public function store(Request $request){
        $categoryObj = new Category;
        $categoryObj->category_name = $request->category_name;
        if (Category::where('category_name', '=', $request->category_name)->exists()) {
            return response()->json(false);
         }else{
            $categoryObj->save();
            return response()->json(true);
         }
    }

    public function edit($id){
        $category = Category::where('id',$id)->get('category_name');
        $category_name = $category[0]['category_name'];
        $content = '<div class="form-group">
                        <input type="text" id="edit-category-id" name="edit_category_id" value="'.$id.'" hidden>
                        <label for="edit-category-name" class="col-form-label">Category Name</label>
                        <input type="text" class="form-control" name="category_name" value="'.$category_name.'">
                    </div>';
        return response()->json($content);
    }

    public function update(Request $request, $id){
        $category = Category::find($id);
        $category->category_name = $request->category_name;
        if (Category::where('category_name', '=', $request->category_name)->exists()) {
            return response()->json(false);
         }else{
            $categoryObj->save();
            return response()->json(true);
         }
    }

    public function destroy($id){
        $categoryToDelete = Category::find($id);
        $categoryToDelete->delete();
        return response()->json(true);
    }
}
