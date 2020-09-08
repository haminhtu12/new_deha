<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductDetails;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    protected $productDetail;
    protected $product;

    public function __construct(ProductDetails $productDetail, Product $product)
    {
        $this->productDetail = $productDetail;
        $this->product = $product;
    }

    public function index()
    {
        return view('productdetails.index')->with([
            'productDetails' => $this->productDetail->all(),
            'products' => $this->product->all()
        ]);
    }

    public function store(Request $request)
    {
        $productDetail = $this->productDetail->createProductDetails($request->all(), $request->file('image'));
        return response(['productDetail' => $productDetail]);
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }

    public function list()
    {
        $productDetails = $this->productDetail->all();
        return view('productdetails.list')->with(['productDetails' => $productDetails]);
    }

}
