@extends('layouts.main')

@section('title', $title)

@section('content')
<nav>
    <ul>
        @can('update', \App\Models\Product::class)
        <li>
            <a href="{{ route('product-update-form', ['product' => $product->code,]) }}">Update</a>
        </li>
        @endcan
        @can('delete', \App\Models\Product::class)
        <li>
            <a href="{{ route('product-delete', ['product' => $product->code,]) }}">Delete</a>
        </li>
        @endcan
    </ul>
</nav>


<main>
    <div class="modal">
        <div class="modal-bg">
            <div class="modal-content">
                <img src="{{ Storage::url($product->image) }}" alt="" class="img-product-view">
                <div class="modal-detail">
                    <table class="table-detail">
                        <tr>
                            <td>Code</td>
                            <td>::</td>
                            <td>{{ $product->code }}</td>
                        </tr>
                        <tr>
                            <td>Product</td>
                            <td>::</td>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td>::</td>
                            <td>{{ $product->category->name }}</td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td>::</td>
                            <td>{{ number_format((float) $product->price,2) }}</td>
                        </tr>
                        <tr>
                   
                  
                            <td colspan="3"><button><a href="{{ route('cart-add-product', [
                    'product' => $product->code,
                    ])}}" class="btn-view">BUY</a></button></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- <table class="view-table" border="1">
        <tr>
            <td>
               <center> <img src="{{ Storage::url($product->image) }}" alt="" class="img-product-view"></center>
            </td>
            <td>
                <table width="100">
                    <tr>
                        <td>Code</td>
                        <td>::</td>
                        <td>{{ $product->code }}</td>
                    </tr>
                    <tr>
                        <td>Product</td>
                        <td>::</td>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>::</td>
                        <td>{{ $product->category->name }}</td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>::</td>
                        <td>{{ number_format((float) $product->price,2) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><button><a href="{{ route('cart-add-product', [
                    'product' => $product->code,
                    ])}}" class="btn-view">BUY</a></button></td>
        </tr>
    </table> -->
</main>

@endsection