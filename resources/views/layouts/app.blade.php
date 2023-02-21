<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
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
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{asset('css/bdzh.css')}}" rel="stylesheet" />
    <link href="{{asset('css/sq.css')}}" rel="stylesheet" />
    <script src="{{asset('https://use.fontawesome.com/releases/v6.1.0/js/all.js')}}" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <span class="text-dark h4">Nation</span>-<span class="text-primary h4">Al</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>



            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @isset($categories)
                <ul class="navbar-nav me-auto">
                    <li class="nav-item ">
                        <div class="dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{config('app.languages')[app()->getLocale()]}}
                            </a>
                            <div class="dropdown-content">
                                @foreach(config('app.languages') as $ln => $lang)
                                    <a class="dropdown-item" href="{{route('switch.lang',$ln)}}">
                                        {{$lang}}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        @if(app()->getLocale() == 'en')<a class="nav-link btn-outline-primary rounded-pill px-3" href="{{route('books.index')}}">All Books</a>
                        @elseif(app()->getLocale() == 'kz')<a class="nav-link btn-outline-primary rounded-pill px-3" href="{{route('books.index')}}">Барлық кітаптар</a>
                        @else<a class="nav-link btn-outline-primary rounded-pill px-3" href="{{route('books.index')}}">Все книги</a>
                        @endif
                    </li>
                    <li class="nav-item">

                        @can('create',App\Models\Book::class)
                            @if(app()->getLocale() == 'en') <a class="nav-link btn-outline-danger rounded-pill px-3" href="{{route('books.create')}}">Create book</a>
                            @elseif(app()->getLocale() == 'kz')<a class="nav-link btn-outline-danger rounded-pill px-3" href="{{route('books.create')}}">Кітап салу</a>
                            @else <a class="nav-link btn-outline-danger rounded-pill px-3" href="{{route('books.create')}}">Добавить книгу</a>
                    @endif
                    @endcan


                        <li class="nav-item">
                            <div class="dropdown">
                                @if(app()->getLocale() == 'en')<a class="nav-link btn-outline-primary rounded-pill px-3">Categories</a>
                                @elseif(app()->getLocale() == 'kz')<a class="nav-link btn-outline-primary rounded-pill px-3">Санаттар</a>
                                @else<a class="nav-link btn-outline-primary rounded-pill px-3">Категории</a>
                                @endif
                                <div class="dropdown-content">
                                @foreach($categories as $cat)
                                    <a class="nav-link btn-outline-primary rounded-pill px-3" href="{{route('books.category',$cat->id)}}">{{$cat->{'name_'.app()->getLocale()} }}</a>
                                    @endforeach
                                </div>
                            </div>
                    @can('userView',\App\Models\Book::class)
                    <li class="nav-item">
                        @if(app()->getLocale() == 'en')<a class="nav-link btn-outline-primary rounded-pill px-3" href="{{route('books.favorite')}}">My favorites</a>
                        @elseif(app()->getLocale() == 'kz')<a class="nav-link btn-outline-primary rounded-pill px-3" href="{{route('books.favorite')}}">Таңдаулыларым</a>
                        @else<a class="nav-link btn-outline-primary rounded-pill px-3" href="{{route('books.favorite')}}">Мои избранные</a>
                        @endif
                    </li>
                    <li class="nav-item">
                        @if(app()->getLocale() == 'en')<a class="nav-link btn-outline-primary rounded-pill px-3" href="{{route('books.subscribed')}}">My Subscribed</a>
                        @elseif(app()->getLocale() == 'kz')<a class="nav-link btn-outline-primary rounded-pill px-3" href="{{route('books.subscribed')}}">Жазылымдарым</a>
                        @else<a class="nav-link btn-outline-primary rounded-pill px-3" href="{{route('books.subscribed')}}">Мои подписки</a>
                        @endif
                    </li>@endcan
                    @endisset
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    @can('viewAny',App\Models\Book::class)
                        @if(app()->getLocale() == 'en')<a class="nav-link" href="{{route('adm.users.index')}}"><p style="font-weight: bold">Admin Panel</p></a>
                        @elseif(app()->getLocale() == 'kz')<a class="nav-link" href="{{route('adm.users.index')}}"><p style="font-weight: bold">Админ беті</p></a>
                        @else <a class="nav-link" href="{{route('adm.users.index')}}"><p style="font-weight: bold">Админ панель</p></a>
                        @endif
                        @endcan
                        @can('view',App\Models\Book::class)
                            @if(app()->getLocale() == 'en')<a class="nav-link" href="{{route('adm.categories.index')}}"><p style="font-weight: bold">Moderator Panel</p></a>
                            @elseif(app()->getLocale() == 'kz')<a class="nav-link" href="{{route('adm.categories.index')}}"><p style="font-weight: bold">Модератор беті</p></a>
                            @else<a class="nav-link" href="{{route('adm.categories.index')}}"><p style="font-weight: bold">Панель Модератора</p></a>
                            @endif
                            @endcan
                            <li class="nav-item ">
                                <div class="dropdown">
                                    @auth
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{__('content_lang.balance')}} {{\Illuminate\Support\Facades\Auth::user()->balance}}$
                                    </a>
                                    <div class="dropdown-content">
                                            <a class="dropdown-item" href="{{route('books.balance',Illuminate\Support\Facades\Auth::user()->id)}}">
                                                {{__('content_lang.upbalance')}}
                                            </a>
                                    </div>
                                    @endauth
                                </div>
                            </li>
                        @guest
                        @if (Route::has('login.form'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register.form'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register.form') }}">{{ __('messages.register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <div class="dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                                <div class="dropdown-content">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
    @endif

    <main class="py-4">
        @yield('content')
    </main>
    <!-- Start Footer -->
    <footer class="bg-secondary pt-4">
        <div class="container">
            <div class="row py-4">

                <div class="col-lg-3 col-12 align-left">
                    <a class="navbar-brand" href="#">
                        <i class='bx bx-buildings bx-sm text-light'></i>
                        <span class="text-light h5">Nation</span> <span class="text-light h5 semi-bold-600">Al</span>
                    </a>
                    <p class="text-light my-lg-4 my-2">
                        {{__('content_lang.footer_about')}}
                    </p>
                    <ul class="list-inline footer-icons light-300">
                        <li class="list-inline-item m-0">
                            <a class="text-light" target="_blank" href="http://facebook.com/">
                                <i class='bx bxl-facebook-square bx-md'></i>
                            </a>
                        </li>
                        <li class="list-inline-item m-0">
                            <a class="text-light" target="_blank" href="https://www.linkedin.com/">
                                <i class='bx bxl-linkedin-square bx-md'></i>
                            </a>
                        </li>
                        <li class="list-inline-item m-0">
                            <a class="text-light" target="_blank" href="https://www.whatsapp.com/">
                                <i class='bx bxl-whatsapp-square bx-md'></i>
                            </a>
                        </li>
                        <li class="list-inline-item m-0">
                            <a class="text-light" target="_blank" href="https://www.flickr.com/">
                                <i class='bx bxl-flickr-square bx-md'></i>
                            </a>
                        </li>
                        <li class="list-inline-item m-0">
                            <a class="text-light" target="_blank" href="https://www.medium.com/">
                                <i class='bx bxl-medium-square bx-md' ></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4 my-sm-0 mt-4">
                    <h2 class="h4 pb-lg-3 text-light light-300">{{__('content_lang.footer_connect')}}</h2>
                    <ul class="list-unstyled text-light light-300">
                        <li class="pb-2">
                            <i class='bx-fw bx bx-phone bx-xs'></i><a class="text-decoration-none text-light py-1" href="tel:8707 572 36 96">+77075723696</a>
                        </li>
                        <li class="pb-2">
                            <i class='bx-fw bx bx-mail-send bx-xs'></i><a class="text-decoration-none text-light py-1" href="mailto:ayan.serikkan@narxoz.kz">ayan.serikkan@narxoz.kz</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="w-100 bg-primary py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-lg-6 col-sm-12">
                        <p class="text-lg-start text-center text-light light-300">
                            © Copyright 2021 Nation-Al Library.
                        </p>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <p class="text-lg-end text-center text-light light-300">
                            {{__('content_lang.footer_des')}} <a rel="sponsored" class="text-decoration-none text-light" href="https://templatemo.com/" target="_blank"><strong>{{__('content_lang.creator')}}</strong></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

</div>
</body>
</html>
