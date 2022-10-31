<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('tilte')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/project.css')}}">

</head>

<body>
    <header>
        <nav class="manu-list">
            <ul>
                <li class="home">
                    <a href="{{ route('index') }}">HOME</a>
                </li>
                <li class="product">
                    <a href="{{ route('product-list') }}">PRODUCTS</a>
                </li>
                <li class="category">
                    <a href="{{ route('category-list') }}">CATEGORY</a>
                    <div class="sub-menu">
                        <ul>
                            @foreach(App\Models\Category::all() as $category)
                            <li><a href="{{ route('product-list',['category_id'=>$category->id]) }}">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                @auth
                <li>
                    <a href="{{ route('cart-completed')}}">ORDERED</a>
                </li>
                @endauth
                @auth
                @can('view', \App\Models\User::class)
                <li>
                    <a href="{{route('user-list')}}">USER</a>
                </li>
                @endcan

                <nav class="user-panel">
                    <li>{{ \Auth::user()->name }}</li>
                    <a href="{{ route('logout') }}">Logout</a>
                </nav>
                @endauth

                @guest
                <li><a href="{{ route('login')}}">LOG IN</a></li>
                @endguest
            </ul>

        </nav>
        <center><img src="{{ asset('images/index/' . 'logo.png') }}" alt="index" style="width: 70px; " class="logo"></center>
        <h1 class="title">
            @yield('title')
        </h1>
    </header>

    @if(session()->has('status'))
    <div class="status">
        <span class="info">{{ session()->get('status') }}</span>
    </div>
    @endif

    @error ('error')
    <div class="status">
        <span class="warn">{{ $message }}</span>
    </div>
    @enderror

    <div class="cmp-content">
        @yield('content')
    </div>


    <footer>
        <center>
            © copyright Web Programming Term Project 2022<br>
            -- Ban Don Luang cotton Weaving Community -- </center>
    </footer>
</body>

</html>