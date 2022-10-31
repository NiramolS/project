@extends('layouts.main')

@section('title', $title)

@section('content')

<form action="{{ route('cart-update') }}" method="post">
    @csrf
    <table class="cart-list">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Total Price</th>
        </tr>

        @foreach($products as $product)
        <tr>
            <td><img src="{{ Storage::url($product->image) }}" alt="" class="img-detail-com"></td>
            <td>{{ $product->name }}</td>
            <td> <input type="number" value="{{ $product->pivot->amount }}" name="items[{{$product->id}}][amount]">
           <!-- itemPrice=ราคาต่อหน่วย ยังไม่คูณ-->
             <input type="number" value="{{ $product->price  }}" name="items[{{$product->id}}][itemPrice]" hidden> </td>

            <td>{{ $product->pivot->price }}</td>
            <td><nav><a href="{{ route('cart-remove-product', [
                    'product' => $product->code,
                    ])}}">Remove</a><nav>
               </td>
        </tr>
        @endforeach

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td class="total-price">{{ $cart->total_price}}</td>
        </tr>
    </table>

    <button type="submit">Update Cart</button>
    <button><a href="{{ route('cart-confirm') }}">Confirm</a></button>
</form>
@endsection