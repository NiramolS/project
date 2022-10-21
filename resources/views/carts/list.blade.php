@extends('layouts.main')

@section('title', $title)

@section('content')

<form action="{{ route('cart-update') }}" method="post">
    @csrf
    <table>
        <tr>
            <td>Image</td>
            <td>Name</td>
            <td>Amount</td>
            <td>Total Price</td>
        </tr>

        @foreach($products as $product)
        <tr>
            <td>{{ $product->image }}</td>
            <td>{{ $product->name }}</td>
            <td> <input type="number" value="{{ $product->pivot->amount }}" name="items[{{$product->id}}][amount]">
           <!-- itemPrice=ราคาต่อหน่วย ยังไม่คูณ-->
             <input type="number" value="{{ $product->price  }}" name="items[{{$product->id}}][itemPrice]" hidden> </td>

            <td>{{ $product->pivot->price }}</td>
            <td><a href="{{ route('cart-remove-product', [
                    'product' => $product->code,
                    ])}}"> Remove</a>
               </td>
        </tr>
        @endforeach
    </table>

    <button type="submit">Update Cart</button>
</form>
@endsection