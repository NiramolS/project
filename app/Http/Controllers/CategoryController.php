<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Psr\Http\Message\ServerRequestInterface as Request;

class CategoryController extends SearchableController
{
    private string $title = 'Ban Don Luang cotton Weaving Community';


    function getQuery(): Builder
    {
        return Category::OrderBy('code');
    }


    function list(Request $request)
    {
        $search = $this->prepareSearch($request->getQueryParams());
        $query = $this->search($search);

        return view('categories.list', [
            'title' => "{$this->title}",
            'search' => $search,
            'categories' => $query->paginate(10),
        ]);
    }

    function show($categoryCode)
    {
        $category = Category::where('code', $categoryCode)->firstOrFail();
        return view('categories.view', [
            'title' => "{$this->title}",
            'category' => $category,

        ]);
    }

    function createForm()
    {
        //Retriev categories
        
        
        return view('products.create-form', [
            'title' => "Create Product",
            
        ]);
    }


    function create(Request $request)
    {
        $cate = Category::create($request->getParsedBody());

        return redirect()->route('category-list');
    }


    function updateForm($categoryCode)
    {


        $category = $this->find($categoryCode);

        return view('categories.update-form', [
            'title' => "{$this->title} : Update",
            'category' => $category,
        ]);
    }

    function update(Request $request, $productCode)
    {
        //$product = Product::updated($request->getParsedBody());

        $product = $this->find($productCode);
        $product->fill($request->getParsedBody());
        $product->save();

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
