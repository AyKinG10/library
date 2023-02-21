<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
class CommentController extends Controller
{
    public function store(Request $req){
        $validated=$req->validate([
            'content'=>'required',
            'book_id'=>'required|numeric|exists:books,id',
        ]);
        Auth::user()->comments()->create($validated);
        return back()->with("Comments is created sucsessfully");
    }



    public function edit(Comment $comment){
        return view('comment.edit',['comment'=>$comment,'categories'=>Category::all()]);
    }
    public function update(Request $req,comment $comment){
        $comment->update([
            'content'=>$req->input('content'),
            'post_id'=>$req->input('book_id'),

        ]);
        return redirect(route('books.show',[$comment->book_id]));

    }
    public function destroy(Comment $comment){
        $this->authorize('delete',$comment);
        $comment->delete();
        return redirect(route('books.show',[$comment->book_id]));
    }

}
