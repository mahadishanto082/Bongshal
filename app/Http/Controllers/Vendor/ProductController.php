<?php

namespace App\Http\Controllers\Vendor;


use App\Http\Controllers\Controller;
use App\Traits\Media;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Merchant;
use App\Models\ProductImage; // Assuming you have a ProductImage model

 // Assuming you have a Merchant model

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
        
        $brands = Brand::all();// Categories created by admin
        $merchants = Merchant::all();
        
        $pro = Product::select('sort')->orderBy('sort', 'DESC')->first();
        if ($pro) {
            $lastSortNumber = $pro->sort + 1;
        } else {
            $lastSortNumber = 1;
        }
       

        return view('website.vendor.products.create', compact('categories', 'brands', 'merchants', 'lastSortNumber'));

    }

    /**
     * Store a new product submitted by vendor
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:100|unique:products,code',
        'category_id' => 'required|exists:categories,id',
        'brand_id' => 'nullable|exists:brands,id',
        'buy_price' => 'required|numeric|between:0,999999.99',
        'price' => 'required|numeric|min:0',
        'discount_type' => 'nullable|in:Taka,Percentage',
        'discount_value' => 'nullable|numeric|min:0',

        'discount' => 'nullable|numeric|min:0',
        'description' => 'nullable|string',
        'sort' => 'nullable|integer|min:0',
        'image' => 'required|image|max:2048',
         // validation for image
          'status' => 'required|in:Active,Inactive',
            'feature' => 'required|in:Yes,No',
    ]);

    // Upload image if present
    if ($request->hasFile('image')) {
        $image = $this->imageUpload($request->file('image'), $this->ASSET_PATH);
        $validated['image'] = $image['name']; // Save only filename
    }

    // Set approval and vendor ID
    $validated['approval_status'] = 'pending';
    $validated['vendor_id'] = auth('vendor')->id();

    // Save product
    $product = Product::create($validated);

    // Optional: Save additional product images if you have multiple upload
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


    

    
    public function index()
    {
        // Example: get all products of the vendor
        $vendorId = auth('vendor')->id();
$products = Product::where('vendor_id', $vendorId)->paginate(10);
// or simplePaginate(10)
 // Adjust this logic if you filter by vendor
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
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:100|unique:products,code,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'buy_price' => 'required|numeric|between:0,999999.99',
            'discount_type' => 'nullable|in:Taka,Percentage',
            'discount_value' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);
        

        $product->update($request->all());
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/products', $filename);
        
            $product->image = $filename;
            $product->save();
        }
       

        // if ($request->hasFile('image')) {
        //     $this->uploadMedia($request->file('image'), $product, $this->ASSET_PATH);
            
        // }

        return redirect()->route('vendor.products.index')->with('success', 'Product updated successfully.');
    }
    /**
     * Delete a product.
     */
    public function destroy(Product $product)
    {
        // Delete the product
        $product->delete();

        // Optionally, delete the associated media if needed
        // $this->deleteMedia($product, $this->ASSET_PATH);

        return redirect()->route('vendor.products.index')->with('success', 'Product deleted successfully.');
    }
    

}
