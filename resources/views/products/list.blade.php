@extends('layouts.main')

@section('title', $title)

@section('content')

<body>
<form action="{{ route('product-list') }}" method="get" class="search-form">
    <label for="search">
        <input type="text" placeholder="Search..." name="term" value="{{ $search['term'] }}" />
    </label>
    <button type="submit" class="btn-submit-search">Search</button>
    <a href="{{ route('product-list') }}">
        <button type="button" class="accent">Clear</button>
    </a><br />
</form>
            <button>
                <a href="{{ route('product-create-form') }}">New Product</a>
            </button>

        <div class="paginate">{{ $products->withQueryString()->links() }}</div>

<main class="main-main">

    @foreach($products as $product)
    <div class="container">
        <div class="item">
            <div class="pro">
                <center>
                    <img src="{{ Storage::url($product->image) }}" alt="" >
                    <p><b>{{$product->name}}</b></p>
                    <p>{{ number_format((double)$product->price, 2) }}</p>
                    <button><li><a href="{{ route('product-view', [
                    'product' => $product->code,
                    ])}}" class="btn-view">VIEW PRODUCT</a></li></button>
                    <button><li><a href="{{ route('cart-add-product', [
                    'product' => $product->code,
                    ])}}" class="btn-view">BUY</a></li></button>
                </center>
            </div>
        </div>
    </div>
    @endforeach

    <!-- <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->image }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ number_format((double)$product->price, 2) }}</td>
            <br>
            <a href="{{ route('product-view', [
                    'product' => $product->code,
                    ])}}" class="btn-view">VIEW PRODUCT</a>
            </li>
            <br>
        </tr>
        @endforeach
    </tbody> -->

</main>
</body>
@endsection