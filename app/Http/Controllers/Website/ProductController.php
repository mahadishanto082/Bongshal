<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Models\Product;

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
    // ProductController.php

public function fetchNewArrivals(Request $request)
{
    $perPage = 4 ; // প্রতি পেজে কত প্রোডাক্ট দেখাবে
    $page = $request->input('page', 1);

        $products = Product::where('is_new_arrival', true)
        ->skip(($page - 1) * $perPage)
        ->take($perPage)
        ->get();

    // যদি প্রোডাক্ট না থাকে তাহলে খালি রেসপন্স দিবে
    return response()->json([
        'products' => $products,
        'page' => $page,
        'hasMore' => Product::where('is_new_arrival', true)->skip($page * $perPage)->exists(),
    ]);
}


}
