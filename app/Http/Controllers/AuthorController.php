<?php

namespace App\Http\Controllers;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(){
        $counter = 1;
        $authors = Author::orderBy('id','DESC')->get();
        return view('authors',compact('authors','counter'));
    }

    public function store(Request $request){
        $authorObj = new Author;
        $authorObj->author_name = $request->author_name;
        if (Author::where('author_name', '=', $request->author_name)->exists()) {
            return response()->json(false);
         }else{
            $authorObj->save();
            return response()->json(true);
         }
    }

    public function edit($id){
        $author = Author::where('id',$id)->get('author_name');
        $author_name = $author[0]['author_name'];
        $content = '<div class="form-group">
                        <input type="text" id="edit-author-id" name="edit_author_id" value="'.$id.'" hidden>
                        <label for="edit-author-name" class="col-form-label">Author Name</label>
                        <input type="text" class="form-control" name="author_name" value="'.$author_name.'">
                    </div>';
        return response()->json($content);
    }

    public function update(Request $request, $id){
        $author = Author::find($id);
        $author->author_name = $request->author_name;
        if (Author::where('author_name', '=', $request->author_name)->exists()) {
            return response()->json(false);
         }else{
            $author->save();
            return response()->json(true);
         }
    }

    public function destroy($id){
        $authorToDelete = Author::find($id);
        $authorToDelete->delete();
        return response()->json(true);
    }
}