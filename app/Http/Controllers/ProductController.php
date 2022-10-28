<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
// use App\Models\Shop;
use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\Relations\Relation;
use Psr\Http\Message\ServerRequestInterface as Request;
use Symfony\Component\HttpFoundation\Request as LaravelRequest;
use Illuminate\Database\QueryException;

class ProductController extends SearchableController
{
    private string $title = 'Ban Don Luang cotton Weaving Community';


    function getQuery(): Builder
    {
        return Product::OrderBy('code');
    }


    function list(Request $request)
    {
        $data =  $request->getQueryParams();

        $search = $this->prepareSearch($data);
        $query = $this->search($search)
            ->when(isset($data['category_id']), function ($query) use ($data) {
                $query->where('category_id', $data['category_id']);
            });

        return view('products.list', [
            'title' => "{$this->title}",
            'search' => $search,
            'products' => $query->paginate(10),
            'category' => isset($data['category_id']) ? Category::find($data['category_id']) : NULL,
        ]);
    }

    function show($productCode)
    {
        $product = Product::where('code', $productCode)->firstOrFail();
        return view('products.view', [
            'title' => "{$this->title}",
            'product' => $product,

        ]);
    }

    function createForm()
    {
        $this->authorize('create', Product::class);
        $categories =  Category::orderBy('code')->get();

        return view('products.create-form', [
            'title' => "Create Product",
            'categories' => $categories,
        ]);
    }

    function create(LaravelRequest $request,  CategoryController $categoryController,)
    {
        $this->authorize('create', Product::class);

        try {
            $path = $request->file('image')->store('images', 'public');
            $data = $request->all();

            $product = Product::create([
                'name' => $data['name'],
                'code' => $data['code'],
                'price' => $data['price'],
                'image' => $path,
                'category_id' => $data['category'],
            ]);

            return redirect()->route('product-list')
                ->with('status', "$product->name was created.");
        } catch (QueryException $excp) {
            return redirect()->back()->withInput()->withErrors([
                'error' => $excp->errorInfo[2],
            ]);
        }
    }

    function updateForm($productCode)
    {
        $this->authorize('update', Product::class);
        $categories =  Category::orderBy('code')->get();

        $product = $this->find($productCode);

        return view('products.update-form', [
            'title' => "{$this->title} : Update",
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    function update(LaravelRequest $request, CategoryController $categoryController, $productCode)
    {
        $this->authorize('update', Product::class);

        try {
            $product = $this->find($productCode);
            $path = $request->file('image')->store('images', 'public');
            $data = $request->all();
            $product->update([
                'name' => $data['name'],
                'code' => $data['code'],
                'price' => $data['price'],
                'image' => $path,
                'category_id' => $data['category'],
            ]);

            return redirect()->route('product-view', [
                'product' => $product->code,
            ])
                ->with('status', "$product->name was updated.");
        } catch (QueryException $excp) {
            return redirect()->back()->withInput()->withErrors([
                'error' => $excp->errorInfo[2],
            ]);
        }
    }

    function delete($productCode)
    {
        $this->authorize('delete', Product::class);
        try {
            $product = $this->find($productCode);
            $product->delete();

            return redirect()->route('product-list')
                ->with('status', "$product->name was deleted.");
        } catch (QueryException $excp) {
            return redirect()->back()->withErrors([
                'error' => $excp->errorInfo[2],
            ]);
        }
    }
}
