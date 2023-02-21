
@extends('layouts.app')

@section('title', 'Index Page')

@section('content')
    <section class="py-5 mb-5">
        <div class="container">
            <h1 class="display-3" align="center">{{__('content_lang.subscribe')}}</h1><br>
            <div class="row gy-5 g-lg-5 mb-4">
                @foreach($books as $book)
                    <div class="col-md-4 mb-3">
                        <a href="{{route('books.show',$book->id)}}" class="recent-work card border-0 shadow-lg overflow-hidden">
                            <img class="recent-work-img card-img" src="{{$book->img}}" alt="Card image" height="500">
                            <div class="recent-work-vertical card-img-overlay d-flex align-items-end">
                                <div class="recent-work-content text-start mb-3 ml-3 text-dark">
                                    <h3 class="card-title light-300">{{$book->title}}</h3>
                                    <p class="card-text">{{$book->author}}</p>
                                </div>
                            </div>
                        </a>
                        <form action="{{route('books.unsubscribe',$book->id)}}" method="post" >
                            @csrf
                            <button class="btn btn-danger"  type="submit">Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
