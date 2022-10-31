<?php

namespace App\Http\Controllers;

use App\Exports\CartExport;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Psr\Http\Message\ServerRequestInterface as Request;
use Maatwebsite\Excel\Facades\Excel;

class CartController extends Controller
{
    function list()
    {
        $user = Auth::user();
        $cart = $user->cart()->where('status', 'INCOMPLETE')->first();

        if (!$cart) {
            $cart =  Cart::create([
                'user_id' => $user->id
            ]);
        }

        $products = $cart->products;

        return view('carts.list', [
            'title' => 'Product in cart',
            'products' => $products,
            'cart' => $cart,

        ]);
    }

    function listCompleted() 
    {
        $user = Auth::user();
        $carts = $user->cart()->where('status', 'COMPLETED')->get();

        return view('carts.list-completed', [
            'title' => 'Completed Order',
            'carts' => $carts,
        ]);
    }

    function addProduct($productCode)
    {
        $product = Product::where('code', $productCode)->firstOrFail();

        $user = Auth::user();
        $cart = $user->cart()->where('status', 'INCOMPLETE')->first();

        if (!$cart) {
            $cart =  Cart::create([
                'user_id' => $user->id
            ]);
        }

        $existingProduct = $cart->products()->where('code', $product->code)->first();

        if ($existingProduct) {
            $newAmount = $existingProduct->pivot->amount + 1;

            $cart->products()->updateExistingPivot(
                $existingProduct->id,
                [
                    'amount' => $newAmount,
                    'price' => $existingProduct->price * $newAmount,
                ]
            );
        } else {
            $cart->products()->attach([
                $product->id => [
                    'amount' => 1,
                    'price' => $product->price,
                ]
            ]);
        }

        $totalPrice = $cart->products->sum('pivot.price');
        $cart->update(['total_price' => $totalPrice]);

        return redirect()->route('cart-product-list');
    }

    function removeProduct($productCode)
    {
        $product = Product::where('code', $productCode)->firstOrFail();

        $user = Auth::user();
        $cart = $user->cart()->where('status', 'INCOMPLETE')->first();

        $cart->products()->detach($product);

        $totalPrice = $cart->products->sum('pivot.price');
        $cart->update(['total_price' => $totalPrice]);

        return redirect()->back();
    }

    function update(Request $request)
    {
        $data = $request->getParsedBody();

        $items = $data['items'];


        foreach ($items as $index => $item) {
            $items[$index]['price'] = $item['amount'] * $item['itemPrice'];
            unset($items[$index]['itemPrice']);
        }

        $user = Auth::user();
        $cart = $user->cart()->where('status', 'INCOMPLETE')->first();

        $cart->products()->sync($items);

        $totalPrice = $cart->products->sum('pivot.price');
        $cart->update(['total_price' => $totalPrice]);

        return redirect()->back();
    }

    function confirm()
    {
        $user = Auth::user();
        $cart = $user->cart()->where('status', 'INCOMPLETE')->first();

        $cart->update(['status' => 'COMPLETED']);

        return redirect()->route('cart-completed');
    }

    function cartDetail($cartId) 
    {
       $cart = Cart::with('products')->where('id', $cartId)->firstOrFail();

       return view('carts.list-detail-completed',[
        'title' => 'Orederd Detail',
        'cart' => $cart,
        'products' => $cart->products,
       ]);
    }

    function cartExport($cartId)
    {
        $cart = Cart::with('products')->where('id', $cartId)->firstOrFail();
 
        return Excel::download(new CartExport($cart), 'invoices.xlsx');
     }
}
