
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <a class=" btn btn-outline-primary "  href="{{route('books.index')}}">Go to index page</a>
                <form action="{{route('books.update',$books->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group" style="margin-top: 20px;">
                        <input type="text" class="form-control" name="title" value="{{$books->title}}"><br>
                        <input type="text" class="form-control" name="author" value="{{$books->author}}"><br>
                        <input type="text" class="form-control" name="price" value="{{$books->price}}"><br>
                        <label for="file" class="form-control" name="img">Image</label>
                        <input type="file" class="form-control" name="img" value="{{$books->img}}"><br>
                        <label for="file" class="form-control" name="img">Pdf</label>
                        <input type="file" class="form-control" name="pdf" value="{{$books->pdf}}">
                        <select class="form-control form-control-lg mt-3"  name="category_id" id="">
                            @foreach($categories as $cat)
                                <option @if($cat->id==$books->category_id) selected @endif value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select><br>
                        <button class="btn btn-primary form-control mt-3" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
