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
        $productDetails = $this->productDetail->all();
        $products = $this->product->all();
        return view('product_details.index')->with([
            'productDetails' => $productDetails,
            'products' => $products
        ]);
    }

    public function store(Request $request)
    {
        $productDetail = $this->productDetail->create($request->all(), $request->file('image'));
        return response(['productDetail' => $productDetail]);
    }

    public function edit($id)
    {
        return response()->json([
            'productDetail' => $this->productDetail->findOrFail($id),// gach duoi
        ]);

    }

    public function update(Request $request, $id)
    {
        $productDetail = $this->productDetail->updateProductDetail($id, $request->all(), $request->file('image'));
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
        return view('product_details.list')->with(['productDetails' => $productDetails]);// gach ngang
    }

}
