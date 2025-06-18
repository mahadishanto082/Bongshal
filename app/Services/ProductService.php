<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductService
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return Product::select('products.slug', 'products.name', 'products.description', 'products.image', 'products.price', 'products.discount_type', 'products.discount_value', 'products.point', 'products.stock', 'products.size', 'products.color', 'categories.name as category_name')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->when($request->has('category_id'), function ($q) use ($request) {
                return $q->where('categories.id', $request->category_id);
            })
            ->when($request->filter_by == 'price_desc', function ($q) {
                return $q->orderBy('products.price', 'DESC');
            })
            ->when($request->filter_by == 'price_asc', function ($q) {
                return $q->orderBy('products.price', 'ASC');
            })
            ->when($request->filter_by == 'date_asc', function ($q) {
                return $q->orderBy('products.sort', 'ASC');
            })
            ->when($request->filter_by == 'date_desc', function ($q) {
                return $q->orderBy('products.created_at', 'DESC');
            })
            ->when($request->filter_by == 'a_z', function ($q) {
                return $q->orderBy('products.name', 'ASC');
            })
            ->when($request->filter_by == 'z_a', function ($q) {
                return $q->orderBy('products.name', 'DESC');
            })
            ->when(!in_array($request->filter_by, ['price_desc', 'price_asc', 'date_desc']), function ($q) {
                return $q->orderBy('products.sort', 'ASC'); // Default order by 'created_at' in descending order
            })
            ->when($request->has('keyword'), function ($q) use ($request) {
                return $q->where(function ($q) use ($request) {
                    $q->where('products.name', 'LIKE', "%$request->keyword%")->orWhere('products.description', 'LIKE', "%$request->keyword%");
                });
            })
            ->where('products.status', 'Active')
            ->paginate(12);
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getProductsByCategory(string $slug)
    {
        $category = Category::where('slug', $slug)->first();
        $products = [];
        if ($category) {
            $products = Product::select('products.slug', 'products.name', 'products.description', 'products.image', 'products.stock', 'products.price', 'products.discount_type', 'products.discount_value', 'products.point', 'products.size', 'products.color', 'categories.name as category_name')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->where([
                    'categories.id' => $category->id,
                    'products.status' => 'Active',
                ])
                ->orderBy('products.created_at', 'DESC')
                ->paginate(12);
        }

        return $products;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getSearchedProducts(Request $request)
    {
        return Product::select('products.slug', 'products.name', 'products.description', 'products.image', 'products.price', 'products.discount_type', 'products.discount_value', 'products.point', 'products.size', 'products.color', 'categories.name as category_name')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.status', 'Active')
            ->when($request->has('keyword'), function ($q) use ($request) {
                return $q->where(function ($q) use ($request) {
                    $q->where('products.name', 'LIKE', "%$request->keyword%")
                        ->orWhere('products.description', 'LIKE', "%$request->keyword%");
                });
            })
            ->orderBy('products.created_at', 'DESC')
            ->get();
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function show(string $slug)
    {
        return Product::with(
            'images',
            'category',
            'brand',
            'merchant',
            'writer',
        )
            ->where('slug', $slug)
            ->firstOrFail();
    }
}
