@extends('layouts.main')

@section('title', $title)

@section('content')

<main>
    <table class="order-completed">
        <tr>
            <th>Date</th>
            <th>Total Price</th>
        </tr>
        @foreach($carts as $cart)
        <tr>
            <td>{{ $cart->created_at }}</td>
            <td>{{ $cart->total_price }}</td>
            <td><nav><a href="{{ route('cart-detail', [
                    'cart' => $cart->id,
                    ])}}"> Detail</a></nav></td>
        </tr>
        @endforeach
    </table>
</main>
@endsection