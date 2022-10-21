<?php

namespace App\Exports;

use App\Models\Cart;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CartExport implements FromView
{
    public $cart;

    public function __construct(Cart $cart){
        $this->cart = $cart;
    }
    public function view(): View
    {
        return view('carts.list-detail-export', [
        'title' => 'Orederd Detail',
         'cart' => $this->cart,
         'products' => $this->cart->products,
        ]);
    }
}
