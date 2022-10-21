<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Psr\Http\Message\ServerRequestInterface as Request;

class CartController extends Controller
{
    function list()
    {

        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart) {
            $cart =  Cart::create([
                'user_id' => $user->id
            ]);
        }

        $products = $cart->products;

        return view('carts.list', [
            'title' => 'Product in cart',
            'products' => $products,

        ]);
    }

    function addProduct($productCode)
    {
        $product = Product::where('code', $productCode)->firstOrFail();

        $user = Auth::user();
        $cart = $user->cart;

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

        return redirect()->route('cart-product-list');
    }

    function removeProduct($productCode)
    {
        $product = Product::where('code', $productCode)->firstOrFail();

        $user = Auth::user();
        $cart = $user->cart;

        $cart->products()->detach($product);

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
        $cart = $user->cart;

        $cart->products()->sync($items);

        return redirect()->back();
    }
}
