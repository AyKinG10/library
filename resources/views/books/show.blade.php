@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font CSS -->
    <link href="{{asset('assets/css/boxicon.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Load Tempalte CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/templatemo.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    <link href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet" />


    <div class="container">
        @can('update',$books)
            <form action="{{route('books.destroy',$books->id)}}" method="post">
                @method('delete')
                @csrf
                @if(app()->getLocale() == 'en')
                    <button class="btn btn-danger"  type="submit">Delete</button>
                @elseif(app()->getLocale() == 'kz')
                    <button class="btn btn-danger"  type="submit">Өшіру</button>
                @else
                    <button class="btn btn-danger"  type="submit">Удалить</button>
                @endif
            </form>
            <br>
            <a href="{{route('books.edit',[$books->id])}}">
                @if(app()->getLocale() == 'en')
                    <button type="button" class="btn btn-primary">Edit</button>
                @elseif(app()->getLocale() == 'kz')
                    <button type="button" class="btn btn-primary">Өңдеу</button>
                @else
                    <button type="button" class="btn btn-primary">Редактировать</button>
                @endif</a>
        @endcan
        <div class="row justify-content-center">
            <br>

            <div class="col-md-9">
                    @if($mySubscribe!=0)
                    <div id="wrapper">

                        <div id="container" style="width: auto;height:auto">
                            @can('watch',$books)
                                    <div class="row ">
                                        <div class="col">
                                            <img class="recent-work-img card-img" src="{{$books->img}}" alt="Card image" height="500" width="300">

                                            </a>
                                        </div>

                                        <div class="col-lg-4 pb-5">
                                            <h3 class="font-weight-semi-bold">{{$books->title    }}</h3>
                                            <div class="d-flex mb-3">
                                                <div class="text-primary mr-2">
                                                    @if($avgRating!=0)
                                                            <h5>{{__('content_lang.rating')}}  {{$avgRating}}/5</h5>
                                                    @endif
                                                </div>
                                            </div>
                                            <h3 class="font-weight-semi-bold mb-4">Price:{{$books->price}}</h3>
                                            <p class="mb-4">{{$books->author}}</p>
                                            <form action="{{route('books.likee',$books->id)}}" method="post">
                                                @csrf
                                                    <button class="btn btn-outline-primary" type="submit"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                                        </svg>{{__('content_lang.add_f')}} <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                                        </svg></button>
                                            </form>
                                            <br>
                                            <a class="btn btn-outline-danger" style="margin-left: 20px" href="{{asset($books->pdf)}}">Кітапты Жүктеу</a>
                                            <br><br><br><br><br>

                                        </div>

                                    </div>
                                </div>
                            @endcan
                                <br>
                            </div>
                        </div>
                    </div>
            @else
                <br>

                    <h1 align="center">{{__('content_lang.subs')}} <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                        </svg></h1>
            @endif

            <br>



                    <form action="{{route('books.subscribe', $books->id)}}" method="post">
                        @csrf

                            <div class="form-group">
                                <select name="month" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="">

                                    <option value="1">1 {{__('content_lang.month')}}</option>
                                    <option value="3">3 {{__('content_lang.month')}}</option>
                                    <option value="6">6 {{__('content_lang.month')}}</option>
                                    <option value="12">12 {{__('content_lang.month')}}</option>
                                </select>
                            </div>

                            <h3 class="display-4">{{$books->price}} $</h3>
                            @if(Auth::user()->balance>=$books->price)
                            <button class="btn btn-primary" type="submit">{{$mySubscribe != 0 ? 'Update' : 'Subscribe'}}</button></form>
                            <form action="{{route('books.unsubscribe',$books->id)}}" method="post">
                                @csrf
                                <button class="btn btn-danger"  type="submit">{{__('content_lang.unsubscribebtn')}}</button>
                            </form>
                    </form>
                    @else
                        <h3>{{__('messages.lowbalance')}}.{{__('content_lang.balance')}} {{\Illuminate\Support\Facades\Auth::user()->balance}}</h3>
            @endif
                    <form action="{{route('comment.store')}}" method="post">
                        @csrf
                        <div class="form-group" style="margin-top: 10px;">
                            <input type="hidden" value="{{$books->id}}" name="book_id">
                            {{__('content_lang.comment')}} <textarea class="form-control" name="content" id="" cols="30" rows="4" required></textarea><br>

                            <button type="submit" class="btn btn-primary">{{__('content_lang.addcomment')}}</button>
                        </div>
                    </form>
                <br>
                        <form action="{{route('books.rate',$books->id)}}" method="post">
                            @csrf
                            <div class="card" style="width: 350px">
                                <div class="card-body">
                                    <p style="font-family: 'Times New Roman';font-size: 25px">{{__('content_lang.rate')}} </p>
                                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" style="text-align:center;width: 150px;height: 45px"  name="rating">
                                        @for($i=0;$i<=5;$i++)
                                            <option {{$myRating==$i ? 'selected' : ''}} value="{{$i}}">
                                                {{$i==0 ? 'Not rated' : $i}}
                                            </option>
                                        @endfor
                                    </select></div>
                                <button class="btn btn-outline-success"  type="submit">{{__('content_lang.ratebtn')}}</button>
                            </div></form>
                        <br>
                        <h2 style="text-align: left;font-family: Broadway" >{{__('content_lang.comments')}} </h2>

                        <div class="row">
                            @foreach($books->comments as $comment)
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <p class="card-title" style="text-align: left">{{__('content_lang.comm_author')}} {{$comment->user->name}}</p>
                                            <p style="font-weight: bold" align="center"> {{$comment->content}}</p>
                                            @can('delete',$comment)
                                                <form action="{{route('comment.destroy',$comment->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-primary" type="submit">{{__('adm.delete')}}</button>
                                                </form>
                                        </div>@endcan
                                    </div>@endforeach
                                </div>
                        </div>
        </div>



    <!-- Bootstrap -->
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Load jQuery require for isotope -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <!-- Isotope -->
    <script src="{{asset('assets/js/isotope.pkgd.js')}}"></script>
    <!-- Page Script -->
    <script>
        $(window).load(function() {
            // init Isotope
            var $projects = $('.projects').isotope({
                itemSelector: '.project',
                layoutMode: 'fitRows'
            });
            $(".filter-btn").click(function() {
                var data_filter = $(this).attr("data-filter");
                $projects.isotope({
                    filter: data_filter
                });
                $(".filter-btn").removeClass("active");
                $(".filter-btn").removeClass("shadow");
                $(this).addClass("active");
                $(this).addClass("shadow");
                return false;
            });
        });
    </script>
    <!-- Templatemo -->
    <script src="{{asset('assets/js/templatemo.js')}}"></script>
    <!-- Custom -->
    <script src="{{asset('assets/js/custom.js')}}"></script>

@endsection

