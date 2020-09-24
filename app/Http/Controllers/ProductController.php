<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    protected $product;
    protected $category;

    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;
    }

    public function index()
    {
        $products = $this->product->all();
        $categories = $this->category->all();
        return view('products.index')->with([
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function store(ProductRequest $request)
    {
        $product = $this->product->create($request->all());
        return response(['product' => $product]);
    }

    public function edit($id)
    {
        $product = $this->product->findOrFail($id);
        return response()->json(['product' => $product]);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = $this->product->findOrFail($id)->update($request->all());
        return response()->json(['product' => $product]);

    }

    public function destroy($id)
    {
        $this->product->destroy($id);
    }

    public function list()
    {
        $products = $this->product->all();
        return view('products.list')->with(['products' => $products]);
    }

}
