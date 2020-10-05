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
        return view('product-details.index')->with([
            'productDetails' => $productDetails,
            'products' => $products
        ]);
    }

    public function store(Request $request)
    {
        $productDetail = $this->productDetail->createDetail($request->all(), $request->file('image'));
        return response(['productDetail' => $productDetail]);
    }

    public function edit($id)
    {
        return response()->json([
            'product_detail' => $this->productDetail->findOrFail($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $productDetail = $this->productDetail->updateProductDetail($id, $request->all(), $request->file('image'));
        return response()->json(['productDetails' => $productDetail]);
    }

    public function destroy($id)
    {
        $productDetail = $this->productDetail->findOrFail($id);
        $this->productDetail->deleteImage(FILE_PATH_PRODUCTIVE, $productDetail['image']);
        $this->productDetail->destroy($id);
        return response()->json(['data' => 'remove']);

    }

    public function list()
    {
        $productDetails = $this->productDetail->paginate(7);
        return view('product-details.list')->with(['productDetails' => $productDetails]);// gach ngang
    }

}
