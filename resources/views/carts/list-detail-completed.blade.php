@extends('layouts.main')

@section('title', $title)

@section('content')

<table>
    <tr>
        <td>Image</td>
        <td>Name</td>
        <td>Amount</td>
        <td>Price</td>

    </tr>
    @foreach($products as $product)
        <tr>
            <td><img src="{{ Storage::url($product->image) }}" alt="" class="img-detail-com"></td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->pivot->amount}}</td>
            <td>{{ $product->pivot->price}}</td>

            
        </tr>
        @endforeach
    <tr>
        <td colspan="3">Total Price :: {{ $cart->total_price}}</td>
    </tr>
</table>

<a href=" {{ route('cart-export', ['cart' =>$cart->id]) }}">Download</a>
@endsection