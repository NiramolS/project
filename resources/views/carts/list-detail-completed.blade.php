@extends('layouts.main')

@section('title', $title)

@section('content')



<table class="detail-completed">
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Amount</th>
        <th>Price</th>

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
        <td></td>
        <td></td>
        <td></td>
        <td class="total-price" colspan="3">Total Price :: {{ $cart->total_price}}</td>
    </tr>
</table>

    <button><a href=" {{ route('cart-export', ['cart' =>$cart->id]) }}">Download</a></button>
    @endsection