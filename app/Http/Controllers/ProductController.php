<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        return view('products.index')->with(['products' => $this->product->all()]);
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
