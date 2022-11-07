<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Symfony\Component\HttpFoundation\Request as LaravelRequest;
use Illuminate\Database\QueryException;

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
        //Retrieve categories
        $this->authorize('create', Category::class);
        
        return view('categories.create-form', [
            'title' => "{$this->title} : Create",
            
        ]);
    }


    function create(LaravelRequest $request)
    {
        $this->authorize('create', Category::class);

        try {
        $path = $request->file('image')->store('images', 'public');
        $data = $request->all();
       
        $category = Category::create([
            'name' => $data['name'],
            'code' => $data['code'],
            'image' => $path,
        ]);

        return redirect()->route('category-list')
        ->with('status',"$category->name was created.");
        } catch (QueryException $excp) {
        return redirect()->back()->withInput()->withErrors([
            'error' => $excp->errorInfo[2],
        ]);
        }
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

    function update(LaravelRequest $request, $categoryCode)
    {
        
        $this->authorize('update', Category::class);
        
        try {
        $category = $this->find($categoryCode);
        
        $data = $request->all();
        if(!empty($data['image'])) {
            $path = $request->file('image')->store('images', 'public');
            $category->update([
                'name' => $data['name'],
                'code' => $data['code'],
                'image' => $path,
            ]);
        }
        else
        {
            unset($path);
            $category->update([
                'name' => $data['name'],
                'code' => $data['code'],
            ]);
        }

        return redirect()->route('product-list', [
            'category_id' => $category->id
        ])
        ->with('status',"$category->name was updated.");
    }catch (QueryException $excp) {
        return redirect()->back()->withInput()->withErrors([
            'error' => $excp->errorInfo[2],
        ]);
    }
    }
    function delete($categoryCode)
    {
        $this->authorize('delete', Category::class);
        
        try {
            $category = $this->find($categoryCode);
            $category->delete();
    
            return redirect()->route('category-list')
            ->with('status',"$category->name was deleted.");
    } catch (QueryException $excp) {
        return redirect()->back()->withErrors([
            'error' => $excp->errorInfo[2],
        ]);
    }
    }

}