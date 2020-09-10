<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\ProductDetails;
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
        return response()->json([
            'productDetail' => $this->productDetail->findOrFail($id),
        ]);

    }

    public function update(Request $request, $id)
    {
        $productDetail = $this->productDetail->upDateProductDetail($id, $request->all(), $request->file('image'));
        return response()->json(['productDetails' => $productDetail]);

    }

    public function destroy($id)
    {
        $this->productDetail->destroy($id);
        return response()->json(['data' => 'remove']);

    }

    public function list()
    {
        $productDetails = $this->productDetail->all();
        return view('productdetails.list')->with(['productDetails' => $productDetails]);
    }

}
