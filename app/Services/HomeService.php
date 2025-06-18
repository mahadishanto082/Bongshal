<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeService
{
    public function getAllSliders()
    {
        return  Slider::with('category')->where('status', 'Active')->get();
    }

    public function featureCategoryWithProducts()
    {
        return Category::with('products')->has('products')
            ->where('status', 'Active')
            ->where('feature', 'Yes')
            ->orderBy('created_at', 'DESC')
            ->take(10)
            ->get()
            ->map(function ($query) {
                $query->setRelation('products', $query->products->where('status', 'Active')
                    ->where('feature', 'Yes')
                    ->take(12));
                return $query;
            });
    }

    public function getAllCategories()
    {
        return  Category::where('status', 'Active')->orderBy('created_at', 'DESC')->get();
    }

    public function getProductsByCategory(string $slug)
    {
        $category = Category::where('slug', $slug)->first();
        $products = [];
        if ($category) {
            $products = Product::select('products.slug', 'products.name', 'products.description', 'products.image', 'products.price', 'products.discount_type', 'products.discount_value', 'products.point', 'products.stock', 'products.size', 'products.color', 'categories.name as category_name')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->where([
                    'categories.id' => $category->id,
                    'products.status' => 'Active',
                ])
                ->orderBy('products.sort', 'ASC')
                ->paginate(12);
        }

        $data = [
            'category' => $category,
            'products' => $products,
        ];

        return $data;
    }

    public function newArrivalProducts()
    {
        $products = Product::select('products.slug', 'products.name', 'products.description', 'products.image', 'products.price', 'products.discount_type', 'products.discount_value', 'products.point', 'products.stock', 'products.size', 'products.color', 'categories.name as category_name')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->orderBy('products.sort', 'ASC')
            ->take(12)
            ->get();

        return $products;
    }
}
