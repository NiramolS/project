<?php
/*
namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Builder;
use Psr\Http\Message\ServerRequestInterface as Request;

class ShopController extends SearchableController
{
    private string $title = 'Ban Don Luang cotton Weaving Community';

    function getQuery(): Builder
    {
        return Shop::OrderBy('code');
    }

    function list(Request $request)
    {
        $search = $this->prepareSearch($request->getQueryParams());
        $query = $this->search($search);

        return view('shops.list', [
            'title' => "{$this->title}",
            'search' => $search,
            'shops' => $query->paginate(10),
        ]);
    }

    function show($shopCode)
    {
        $shop = Shop::where('code', $shopCode)->firstOrFail();

        return view('shops.view', [
            'title' => "{$this->title}",
            'shop' => $shop,
        ]);
    }

    function createForm()
    {
        return view('shops.create-form', [
            'title' => "Create Shop",
        ]);
    }

    function create(Request $request)
    {
        $shop = Shop::create($request->getParsedBody());

        return redirect()->route('shop-list');
    }

    function updateForm( $shopCode)
    {
        $shop = $this->find($shopCode);

        return view('shops.update-form', [
            'title' => "{$this->title} : Update",
            'shop' => $shop,
        ]);
    }

    function update(Request $request, $shopCode)
    {
        $shop = $this->find($shopCode);
        $shop->fill($request->getParsedBody());
        $shop->save();

        return redirect()->route('shop-view', [
            'shop' => $shop->code,
        ]);
    }

    function delete($shopCode)
    {
        $shop = $this->find($shopCode);
        $shop->delete();

        return redirect()->route('shop-list');
    }
}
*/