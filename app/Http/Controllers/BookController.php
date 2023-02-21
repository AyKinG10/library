<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{

    public function balance(){
        return view('books.balance');
    }
    public function balanceStore(Request $request){
        Auth::user()->update([
            'balance'=>Auth::user()->balance + $request->input('balance'),'required|numeric',
        ]);
        return back(    )->with('message',__('messages.balance'));
    }


    public function buyBook(Book $book){
        if(Auth::user()->balance>=$book->price){
            Auth::user()->update([
                'balance'=>Auth::user()->balance-$book->price,'required|numeric',
            ]);
            return back();
        }
        else
            return back()->with('message',__('messages.lowbalance'));
    }


    public function favorites(){
        $prikol=Auth::user()->booksLiked()->get();
        return view('books.favorites',['books'=>$prikol,'categories'=>Category::all()]);
    }


    public function subscribed(){
        $subs=Auth::user()->booksSubs()->get();
        return view('books.subscribe',['books'=>$subs,'categories'=>Category::all()]);
    }


    public function subscribe(Request $request,Book $book){
        $request->validate([
            'month'=>'required'
        ]);
        $bookSubs=Auth::user()->booksSubs()->where('book_id',$book->id)->first();
        if($bookSubs!=null){
            Auth::user()->booksSubs()->updateExistingPivot($book->id,['month'=>$request->input('month')]);
        }
        else{
            Auth::user()->booksSubs()->attach($book->id,['month'=>$request->input('month'),
                                                        'created_at'=>Carbon::now()->addHours(6),
                                                        'updated_at'=>Carbon::now()->addHours(6)]);
        }
        if(Auth::user()->balance>=$book->price){
            Auth::user()->update([
                'balance'=>Auth::user()->balance-$book->price,'required|numeric',
            ]);
            return back();
        }
        return back()->with('message',__('messages.booksubscribe'));
    }


    public function unsubscribe(Book $book){
        $booksSubs=Auth::user()->booksSubs()->where('book_id',$book->id)->first();
        if($booksSubs != null){
                Auth::user()->booksSubs()->detach($book->id);
        }
        return back()->with('message',__('messages.unbooksubscribe'));
    }


    public function liked(Book $book){
        $likedBook=Auth::user()->booksLiked()->where('book_id',$book->id)->first();

        if($likedBook!= null){
            Auth::user()->booksLiked()->detach($book->id);
        }

        return back()->with('message',__('messages.unbooklikes'));
    }



    public function bookLike(Book $book){
        $likedBook=Auth::user()->booksLiked()->where('book_id',$book->id)->first();

        if($likedBook!= null){
            Auth::user()->booksLiked()->detach($book->id);
        }
        else{
            Auth::user()->booksLiked()->attach($book->id);
        }

        return back()->with('message',__('messages.booklikes'));
    }


    public function rate(Request $request,Book $book){
        $request->validate([
            'rating'=>'required|min:1|max:5'
        ]);
        $bookRated = Auth::user()->booksRated()->where('book_id',$book->id)->first();
        if($bookRated!=null){
            Auth::user()->booksRated()->updateExistingPivot($book->id,['rating'=>$request->input('rating')]);
        }
        else {
            Auth::user()->booksRated()->attach($book->id, ['rating' => $request->input('rating')]);
        }
        return back();
    }


    public function unrate(Book $book){
        $bookRated=Auth::user()->booksRated()->where('book_id',$book->id)->first();
        if($bookRated != null)
            Auth::user()->booksRated()->detach($book->id);
        return back();
    }
    public function booksByCategory(Category $category){
        return view('books.index',['books'=>$category->books,'categories'=>Category::all()]);
    }


    public function index(Request $request){

        $allBooks = Book::all();
        return view('books.index',['books'=>$allBooks,'categories'=>Category::all()]);
    }


    public function create(){
        $this->authorize('create',Book::class);
        return view('books.create',['categories'=>Category::all()]);
    }


    public function store(Request $req){
        $this->authorize('create',Book::class);
        $validated= $req->validate([
            'title' => 'required|max:255',
            'img'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=50,min_height=50',
            'pdf' => 'required|mimes:doc,docx,pdf,txt',
            'author'=>'required',
            'price'=>'required|numeric',
            'category_id' => 'required|numeric|exists:categories,id'
        ]);
        $fileName=time().$req->file('img')->getClientOriginalName();
        $image_path=$req->file('img')->storeAs('books',$fileName,'public');
        $validated['img']= '/storage/'.$image_path;

        $fileName2=time().$req->file('pdf')->getClientOriginalName();
        $doc_path=$req->file('pdf')->storeAs('books',$fileName2,'public');
        $validated['pdf']= '/storage/'.$doc_path;

        Auth::user()->books()->create($validated);
        return redirect(route('books.index'))->with('message',__('messages.createbook'));
    }


    public function show(Book $book){
        $fav=0;
        if(Auth::check())
        {
            $favorite_book = Auth::user()->booksLiked()->where('book_id',$book->id)->first();
            if($favorite_book!=null)
            {
                $fav=$favorite_book->book_id;
            }
        }

        $mySubscribe = 0;
        $myCreate = 0;

        if(Auth::check()){
            $bookSubscribed = Auth::user()->booksSubs()->where('book_id', $book->id)->first();
            if($bookSubscribed != null)
                $mySubscribe = $bookSubscribed->pivot->month;
            if ($mySubscribe != null)
                $myCreate = $bookSubscribed->pivot->updated_at;
        }

        $myRating=0;
        $bookRating=Auth::user()->booksRated()->where('book_id',$book->id)->first();
        if($bookRating != null)
            $myRating=$bookRating->pivot->rating;
        $avgRating=0;
        $sum=0;
        $ratedUsers=$book->usersRated()->get();
        foreach ($ratedUsers as $rateUser){
            $sum+=$rateUser->pivot->rating;
        } if(count($ratedUsers)>0)
                $avgRating=$sum/count($ratedUsers);
        return view('books.show',['books'=>$book,'fav'=>$fav,'mySubscribe'=>$mySubscribe,'myCreate'=>$myCreate,'myRating'=>$myRating,'avgRating'=>$avgRating,'comment'=>Comment::all(),'categories'=>Category::all()]);
    }


    public function edit(Book $book)
    {
        return view('books.edit',['books'=>$book,'categories'=>Category::all()]);
    }


    public function update(Request $request,Book $book)
    {
        $fileName=time().$request->file('img')->getClientOriginalName();
        $image_path=$request->file('img')->storeAs('books',$fileName,'public');


        $fileName2=time().$request->file('pdf')->getClientOriginalName();
        $doc_path=$request->file('pdf')->storeAs('books',$fileName2,'public');

        $book->update([
            'title'=>$request->input('title'),
            'img'=>'/storage/'.$image_path,
            'author'=>$request->input('author'),
            'price'=>$request->input('price '),
            'pdf'=>'/storage/'.$doc_path,
            'category_id'=>$request->category_id,
        ]);
        return redirect(route('books.index'))->with('message',__('messages.updatebook'));
    }


    public function destroy(Book $book)
    {
        $this->authorize('delete',$book);
        $book->delete();
        return redirect(route('books.index'))->with('message',__('messages.deletebook'));
    }
}
