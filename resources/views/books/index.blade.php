
@extends('layouts.app')

@section('title', 'Nation_Al')

@section('content')<!DOCTYPE html>
<html lang="en">


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="{{asset('assets/img/apple-icon.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.ico')}}">
    <!-- Load Require CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font CSS -->
    <link href="{{asset('assets/css/boxicon.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Load Tempalte CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/templatemo.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">


<body>
<div class="banner-wrapper bg-light">
    <div id="index_banner" class="banner-vertical-center-index container-fluid pt-5">

        <!-- Start slider -->
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">

                    <div class="py-5 row d-flex align-items-center">
                        <div class="banner-content col-lg-8 col-8 offset-2 m-lg-auto text-left py-5 pb-5">
                            <h1 class="banner-heading h1 text-secondary display-3 mb-0 pb-5 mx-0 px-0 light-300 typo-space-line">
                                <strong>Кітап</strong> оқып
                                <br>зейініңді аш
                            </h1>
                            <p class="banner-body text-muted py-3 mx-0 px-0">
                                Бүкіл кітап атаулының барлығын бір нәрсе біріктіреді – <br> әңгімеленіп жатқан шығармалар шынайлылықтан гөрі шыншыл келеді.
                            </p>
                           </div>
                    </div>

                </div>
                <div class="carousel-item">
                    <div class="py-5 row d-flex align-items-center">
                        <div class="banner-content col-lg-8 col-8 offset-2 m-lg-auto text-left py-5 pb-5">
                            <h1 class="banner-heading h1 text-secondary display-3 mb-0 pb-3 mx-0 px-0 light-300">
                                Читать<strong>книгу</strong>
                                <br>грамотный голод
                            </h1>
                            <p class="banner-body text-muted py-3">
                                Все книги объединяет одно- <br> рассказываемые произведения скорее правдивы, чем правдивы.
                            </p>
                             </div>
                    </div>

                </div>
                <div class="carousel-item">

                    <div class="py-5 row d-flex align-items-center">
                        <div class="banner-content col-lg-8 col-8 offset-2 m-lg-auto text-left py-5 pb-5">
                            <h1 class="banner-heading h1 text-secondary display-3 mb-0 pb-3 mx-0 px-0 light-300">
                                Open up to
                                <br>read a <strong>Book</strong>
                            </h1>
                            <p class="banner-body text-muted py-3">
                                All the titles of the book are united by one thing-<br>the works being narrated are more truthful than truthful.
                            </p>
                            </div>
                    </div>

                </div>
            </div>
            <a class="carousel-control-prev text-decoration-none" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                <i class='bx bx-chevron-left'></i>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next text-decoration-none" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                <i class='bx bx-chevron-right'></i>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
        <!-- End slider -->

    </div>
</div>
<!-- End Banner Hero -->



<!-- Start Service -->
<section class="service-wrapper py-3">
    <div class="container-fluid pb-3">
        <div class="row">
            <h2 class="h2 text-center col-12 py-5 semi-bold-600">{{__('content_lang.title_naq')}}</h2>
            <div class="service-header col-2 col-lg-3 text-end light-300">
                <i class='bx bx-gift h3 mt-1'></i>
            </div>
            <div class="service-heading col-10 col-lg-9 text-start float-end light-300">
                <h3 class="h4 pb-3 typo-space-line">{{__('content_lang.proverb')}}</h3>
            </div>
        </div>
        <p class="service-footer col-10 offset-2 col-lg-9 offset-lg-3 text-start pb-3 text-muted px-2">
            {{__('content_lang.author')}}
        </p>
    </div>
</section>
<!-- Start Recent Work -->
<section class="py-5 mb-5">
    <div class="container">
        <div class="recent-work-header row text-center pb-5">
            <h2 class="col-md-6 m-auto h2 semi-bold-600 py-5">{{__('content_lang.books')}}</h2>
        </div>
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
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- End Recent Work -->





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

</body>

</html>
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--        @foreach($books as $book)--}}
{{--                        <div class="col-sm-4">--}}
{{--                         <div class="card">--}}
{{--                             <div class="card-body text-center">--}}
{{--                                 <img class="card-img-top" src="{{asset($book->img)}}" width="100px" height="300px" alt="Card image cap">--}}
{{--                                 <br><br>--}}
{{--                                 <h2 class="card-title">{{$book->title}}</h2>--}}
{{--                                 <h5 class="card-title" align="center">Типі:{{$book->author}}</h5>--}}
{{--                                 <p style="font-weight: bold" align="right">Editer: {{$book->user->name}}</p>--}}
{{--                                 <a href="{{route('books.show',$book->id)}}" class="btn btn-primary">Read More</a>--}}
{{--                             </div>--}}
{{--                         </div>--}}
{{--                        </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
