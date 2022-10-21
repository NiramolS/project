@extends('layouts.main')

@section('title', $title)

@section('content')

<table>
    <tr>
        <td>Date</td>
        <td>Total Price</td>
    </tr>
    @foreach($carts as $cart)
        <tr>
            <td>{{ $cart->created_at }}</td>
            <td>{{ $cart->total_price }}</td>
            <td><a href="{{ route('cart-detail', [
                    'cart' => $cart->id,
                    ])}}"> Detail</a></td>
        </tr>
        @endforeach
</table>
@endsection