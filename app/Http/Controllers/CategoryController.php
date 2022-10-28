<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Symfony\Component\HttpFoundation\Request as LaravelRequest;


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
        $this->authorize('create', Category::class);
        
        return view('categories.create-form', [
            'title' => "{$this->title} : Create",
            
        ]);
    }


    function create(LaravelRequest $request)
    {
        $this->authorize('create', Category::class);

        $path = $request->file('image')->store('images', 'public');
        $data = $request->all();
       
        $category = Category::create([
            'name' => $data['name'],
            'code' => $data['code'],
            'image' => $path,
        ]);

        return redirect()->route('category-list')
        ->with('status',"$category->name was created.");
    }


    function updateForm($categoryCode)
    {
        $this->authorize('update', Category::class);

        $category = $this->find($categoryCode);

        return view('categories.update-form', [
            'title' => "{$this->title} : Update",
            'category' => $category,
        ]);
    }

    function update(Request $request, $categoryCode)
    {
        //$category = category::updated($request->getParsedBody());

        $this->authorize('update', Category::class);

        $category = $this->find($categoryCode);
        $category->fill($request->getParsedBody());
        $category->save();

        return redirect()->route('product-list', [
            'category_id' => $category->id
        ])
        ->with('status',"$category->name was updated.");
    }

    function delete($categoryCode)
    {
        $this->authorize('delete', Category::class);

        $category = $this->find($categoryCode);
        $category->delete();

        return redirect()->route('category-list')
        ->with('status',"$category->name was deleted.");
    }
}
