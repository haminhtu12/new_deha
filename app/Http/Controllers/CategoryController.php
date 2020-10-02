<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Http\Requests\CategoryRequest;


class CategoryController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $category = $this->category::all();
        return view('categories.index')->with(['categories' => $category]);
    }

    public function store(CategoryRequest $request)
    {
        $category = $this->category->create($request->all());

        return response(['category' => $category]);
    }

    public function edit($id)
    {
        $category = $this->category->findOrFail($id);
        return response()->json(['category' => $category,]);
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = $this->category->findOrFail($id)->update($request->all());
        return response()->json(['category' => $category]);
    }

    public function destroy($id)
    {
        $this->category->destroy($id);
        return response()->json(['data' => 'Delete success category']);
    }

    public function list()
    {
        $categories = $this->category->paginate(2);
        return view('categories.list')->with(['categories' => $categories]);
    }

}
