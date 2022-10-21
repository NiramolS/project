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
                <li class="home"><a href="{{ route('index') }}">HOME</a> </li>
                <li class="product"><a href="{{ route('product-list') }}">PRODUCTS</a></li>
                <li class="category"><a href="{{ route('category-list') }}">CATEGORY</a> 
                    <div class="sub-menu">
                        <ul>
                            @foreach(App\Models\Category::all() as $category)
                            <li><a href="{{ route('product-list',['category_id'=>$category->id]) }}">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li><a>CONTACT US</a></li>
                    
                    
                     <!-- <a>USERS</a>
                    เหลือ status error -->
                
            </ul>
            @auth
        <nav class="user-panel">
            <span>{{ \Auth::user()->name }}</span>
            <a href="{{ route('logout') }}">Logout</a>
        </nav>
        @endauth
            <nav class="user-panel">
                Logout
            </nav>
        </nav>
        <center><img src="{{ asset('images/index/' . 'logo.png') }}" alt="index" style="width: 70px; " class="logo"></center>
        <h1 class="title">
            @yield('title')
        </h1>
        

    </header>

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