<!-- @extends('layouts.main')

@section('title', $title)

@section('content')

<form action="{{ route('shop-list') }}" method="get" class="search-form">
    <label for="search">
        <input type="text" placeholder="Search..." name="term" value="{{ $search['term'] }}" />
    </label>
    <button type="submit" class="btn-submit-search">Search</button>
    <a href="{{ route('shop-list') }}">
        <button type="button" class="accent">Clear</button>
    </a><br />
</form>

<nav>
    <ul>
        <li>
            <a href="{{ route('shop-create-form') }}">New Shop</a>
        </li>
    </ul>
</nav>

<div class="paginate">{{ $shops->withQueryString()->links() }}</div>

<main class="main-main">

    @foreach($shops as $shop)
    <div class="container">
        <div class="item">
            <div class="pro">
                <center>
                    <img src="https://www.touronthai.com/gallery/photo/14000047/24014.jpg" alt="" ; style="width: 80%" ;>
                    <p><b>{{$shop->name}}</b></p>
                    <button>
                        <li><a href="{{ route('shop-view', [
                    'shop' => $shop->code,
                    ])}}" class="btn-view">VIEW SHOP</a></li>
                    </button>
                </center>
            </div>
        </div>
    </div>
    @endforeach

</main>
@endsection -->