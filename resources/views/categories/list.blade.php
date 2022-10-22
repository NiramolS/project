@extends('layouts.main')

@section('title', $title)

@section('content')

<body>
    <form action="{{ route('category-list') }}" method="get" class="search-form">
        <label for="search">
            <input type="text" placeholder="Search..." name="term" value="{{ $search['term'] }}" />
        </label>
        <button type="submit" class="btn-submit-search">Search</button>
        <a href="{{ route('product-list') }}">
            <button type="button" class="accent">Clear</button>
        </a><br />
    </form>


    <div class="paginate">{{ $categories->withQueryString()->links() }}</div>

    <main class="main-main">
    

        @foreach($categories as $category)
        <div class="container">
            <div class="item">
                <div class="pro">
                    <center>
                        <p>
                            <b>
                                <img src="{{ Storage::url($category->image) }}" alt="">
                                <a href="{{ route('product-list',['category_id'=>$category->id]) }}">{{$category->name}}</a>
                            </b>
                        </p>
                    </center>
                </div>
            </div>
        </div>
        @endforeach

    </main>
</body>
@endsection