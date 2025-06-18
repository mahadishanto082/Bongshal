<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * The ProductService instance.
     *
     * @var ProductService $productService
     */
    private ProductService $productService;

    /**
     * Create a new controller instance.
     *
     * @param void
     * @return void
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(Request $request)
    {
        $products = $this->productService->index($request);
        return view('website.products.index', compact('products'));
    }

    public function details($slug)
    {
        $product = $this->productService->show($slug);
        $relatedProducts = [];
        if ($product->category) {
            $relatedProducts = $this->productService->getProductsByCategory($product->category->slug);
        }
        return view('website.products.details', compact('product', 'relatedProducts'));
    }

    public function quickView($slug)
    {
        $product = $this->productService->show($slug);
        $data = view('website.products._quick-view', compact('product'))->render();

        if ($product) {
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Product not found."
            ]);
        }
    }

}
