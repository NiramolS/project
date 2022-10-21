
<table>
    <tr>
        <td colspan="3">Receipt</td>
    </tr>
    <tr>
        <td>Date</td>
        <td colspan="2">{{ $cart->created_at }}</td>
    </tr>
    <tr>
        <td>Customer</td>
        <td colspan="2">{{ $cart->user->name }}</td>
    </tr>
</table>

<table>
    <tr>
        <td>Name</td>
        <td>Amount</td>
        <td>Price</td>

    </tr>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->pivot->amount}}</td>
            <td>{{ $product->pivot->price}}</td>

            
        </tr>
        @endforeach
    <tr>
        <td colspan="3">Total Price :: {{ $cart->total_price}}</td>
    </tr>
</table>
