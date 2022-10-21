<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
// use App\Models\Shop;
use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\Relations\Relation;
use Psr\Http\Message\ServerRequestInterface as Request;
use Symfony\Component\HttpFoundation\Request as LaravelRequest;

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
        $categories =  Category::orderBy('code')->get();

        return view('products.create-form', [
            'title' => "Create Product",
            'categories' => $categories,
        ]);
    }

    function create(LaravelRequest $request,  CategoryController $categoryController,)
    {
        $path = $request->file('image')->store('images', 'public');
        $data = $request->all();
        $category = $categoryController->find($data['category']);

        $product = Product::create([
            'name' => $data['name'],
            'code' => $data['code'],
            'price' => $data['price'],
            'image' => $path,
            'category_id' => $data['category'],
        ]);

        return redirect()->route('product-list');
    }

    function updateForm($productCode)
    {
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
        ]);
    }

    function delete($productCode)
    {
        $product = $this->find($productCode);
        $product->delete();

        return redirect()->route('product-list');
    }
}
