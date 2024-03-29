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

    @can('create',\App\Models\product::class)
    <button>
        <a href="{{ route('product-create-form') }}">New Product</a>
    </button>
    @endcan

    @if($category)
    @can('update',\App\Models\Product::class)
    <nav class="ud" >
    <li>
        <a href="{{ route('category-update-form', ['category' => $category->code,]) }}">Update</a>
    </li>
    @endcan
    @can('delete',\App\Models\Product::class)
    <li>
        <a href="{{ route('category-delete', ['category' => $category->code,]) }}">Delete</a>
    </li>
    </nav>
    @endcan
    @endif

    <div class="paginate">{{ $products->withQueryString()->links() }}</div>

    <main class="main-main">

        @foreach($products as $product)
        <div class="container">
            <div class="item">
                <div class="pro">
                    <center>
                        <img src="{{ Storage::url($product->image) }}" alt="">
                        <p><b>{{$product->name}}</b></p>
                        <p>{{ number_format((double)$product->price, 2) }}</p>
                            <li><a href="{{ route('product-view', [
                    'product' => $product->code,
                    ])}}" class="btn-view">VIEW PRODUCT</a></li>
                            <li><a href="{{ route('cart-add-product', [
                    'product' => $product->code,
                    ])}}" class="btn-view">BUY</a></li>
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