<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Traits\Media;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Merchant;
use App\Models\ProductImage;
use Illuminate\Support\Str; // Import Str helper

class ProductController extends Controller
{
    use Media;

    protected $ASSET_PATH = 'products';
    protected $ROUTE_AND_VIEW = 'vendor.products.';

    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    /**
     * Show the form to create a product (with categories created by admin).
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $merchants = Merchant::all();

        $pro = Product::select('sort')->orderBy('sort', 'DESC')->first();
        $lastSortNumber = $pro ? $pro->sort + 1 : 1;

        return view('website.vendor.products.create', compact('categories', 'brands', 'merchants', 'lastSortNumber'));
    }

    /**
     * Store a new product submitted by vendor.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:100|unique:products,code',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'sort' => 'nullable|integer|min:0',
            'image' => 'required|image|max:2048',
            'status' => 'required|in:Active,Inactive',
            'feature' => 'required|in:Yes,No',
        ]);

        // Generate slug from product name + unique id for uniqueness
        $validated['slug'] = Str::slug($validated['name']) . '-' . uniqid();

        if ($request->hasFile('image')) {
            $image = $this->imageUpload($request->file('image'), $this->ASSET_PATH);
            $validated['image'] = $image['name']; // Save only filename
        }

        $validated['approval_status'] = 'pending';
        $validated['vendor_id'] = auth('vendor')->id();

        $product = Product::create($validated);

        if ($request->hasFile('product_images')) {
            $productImages = [];
            foreach ($request->file('product_images') as $product_image) {
                $imageInfo = $this->imageUpload($product_image, $this->ASSET_PATH . '/products/' . $product->id);
                $productImages[] = [
                    'product_id' => $product->id,
                    'name' => $imageInfo['name'],
                    'url' => $imageInfo['url'],
                    'size' => $imageInfo['size'],
                ];
            }
            ProductImage::insert($productImages);
        }

        return redirect()->route('vendor.products.index')
            ->with('success', 'Product submitted for approval.');
    }

    /**
     * List products belonging to authenticated vendor.
     */
    public function index()
    {
        $vendorId = auth('vendor')->id();
        $products = Product::where('vendor_id', $vendorId)->paginate(10);

        return view('website.vendor.products.index', compact('products'));
    }

    /**
     * Show the form to edit a product.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $merchants = Merchant::all();

        return view('website.vendor.products.edit', compact('product', 'categories', 'brands', 'merchants'));
    }

    /**
     * Update a product submitted by vendor.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:100|unique:products,code,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // Regenerate slug on update to keep consistent with name changes
        $validated['slug'] = Str::slug($validated['name']) . '-' . uniqid();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/products', $filename);

            $validated['image'] = $filename;
        }

        $product->update($validated);

        return redirect()->route('vendor.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Delete a product.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        // Optionally delete associated media if implemented

        return redirect()->route('vendor.products.index')->with('success', 'Product deleted successfully.');
    }
}
