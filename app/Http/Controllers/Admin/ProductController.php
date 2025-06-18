<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Merchant;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Writer;
use App\Traits\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use Media;
    protected $ASSET_PATH = 'products';
    protected $ROUTE_AND_VIEW = 'admin.products.';

    public function index(Request $request)
    {
        $categories = Category::where('status', 'Active')->get();
        $brands = Brand::where('status', 'Active')->get();
        $productSql = Product::with('category', 'brand', 'merchant', 'writer');

        if ($request->key) {
            $productSql->where('name', 'like', '%' . $request->key . '%');
            $productSql->orWhere('code', 'like', '%' . $request->key . '%');
        }

        if ($request->category) {
            $productSql->where('category_id', $request->category);
        }

        if ($request->brand) {
            $productSql->where('brand_id', $request->brand);
        }

        if ($request->price_from < $request->price_to) {
            $productSql->whereBetween('price', [$request->price_from, $request->price_to]);
        }

        $products = $productSql->orderBy('sort', 'ASC')->paginate($request->item_number ?? 15);

        $date = [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
        ];
        return view($this->ROUTE_AND_VIEW . 'index', $date);
    }

    public function create()
    {
        $categories = Category::where('status', 'Active')->get();
        $writers = Writer::where('status', 'Active')->get();
        $brands = Brand::where('status', 'Active')->get();
        $merchants = Merchant::where('status', 'Active')->get();
        $pro = Product::select('sort')->orderBy('sort', 'DESC')->first();
        if ($pro) {
            $lastSortNumber = $pro->sort + 1;
        } else {
            $lastSortNumber = 1;
        }

        $date = [
            'categories' => $categories,
            'writers' => $writers,
            'brands' => $brands,
            'merchants' => $merchants,
            'lastSortNumber' => $lastSortNumber,
        ];
        return view($this->ROUTE_AND_VIEW . 'create', $date);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required|in:Book,General',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'merchant_id' => 'nullable|exists:merchants,id',
            'writer_id' => 'nullable|exists:writers,id',
            'code' => 'required|max:30',
            'name' => 'required|max:256',
            'buy_price' => 'required|numeric|between:0,999999.99',
            'price' => 'required|numeric|between:0,999999.99',
            'discount_type' => 'nullable|in:Taka,Percentage',
            'stock' => 'required|numeric|between:0,5000',
            'point' => 'required|numeric|between:0,1000',
            /*'shipping_in_dhaka'  => 'required|numeric|between:0,999999.99',
            'shipping_out_dhaka' => 'required|numeric|between:0,999999.99',*/
            'status' => 'required|in:Active,Inactive',
            'feature' => 'required|in:Yes,No',
        ]);

        $slug = uniqid() . '-' . Str::slug($request->name);

        $image = '';
        if ($request->has('image')) {
            $image = $this->imageUpload($request->image, $this->ASSET_PATH, '', '');
        }

        if ($request->size) {
            $size = json_encode(explode(',', $request->size));
        }

        if ($request->color) {
            $color = json_encode(explode(',', $request->color));
        }

        if ($request->fabrics) {
            $fabrics = json_encode(explode(',', $request->fabrics));
        }

        $product = Product::create([
            'type' => $request->type,
            'slug' => $slug,
            'category_id' => $request->category_id ?? 0,
            'brand_id' => $request->brand_id ?? 0,
            'merchant_id' => $request->merchant_id ?? 0,
            'code' => $request->code,
            'name' => $request->name,
            'buy_price' => $request->buy_price,
            'price' => $request->price,
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value ?? 0,
            'point' => $request->point,
            'stock' => $request->stock,
            /*'shipping_in_dhaka'  => $request->shipping_in_dhaka,
            'shipping_out_dhaka' => $request->shipping_out_dhaka,*/
            'writer_id' => $request->writer_id ?? 0,
            'first_release' => $request->first_release,
            'language' => $request->language,
            'size' => $size ?? null,
            'color' => $color ?? null,
            'fabrics' => $fabrics ?? null,
            'weight' => $request->weight,
            'warranty' => $request->warranty,
            'description' => $request->description,
            'delivery_info' => $request->delivery_info,
            'image' => $image ? $image['name'] : null,
            'status' => $request->status,
            'feature' => $request->feature,
            'sort' => $request->sort,
        ]);

        if ($product) {
            if (!empty($request->product_images)) {
                $productImages = [];
                foreach ($request->product_images as $product_image) {
                    $imageInfo = $this->imageUpload($product_image, $this->ASSET_PATH . '/products' . $product->id);
                    $productImages[] = [
                        'product_id' => $product->id,
                        'name' => $imageInfo['name'],
                        'url' => $imageInfo['url'],
                        'size' => $imageInfo['size'],
                    ];
                }
                ProductImage::insert($productImages);
            }
        }

        return redirect(route($this->ROUTE_AND_VIEW . 'index'))->with('success', 'Product create successfully');
    }

    public function show(string $id)
    {
        $data = Product::with('images', 'category', 'brand', 'merchant', 'writer')->find($id);
        $date = [
            'data' => $data,
        ];
        return view($this->ROUTE_AND_VIEW . 'view', $date);
    }

    public function edit(string $id)
    {
        $categories = Category::where('status', 'Active')->get();
        $writers = Writer::where('status', 'Active')->get();
        $brands = Brand::where('status', 'Active')->get();
        $merchants = Merchant::where('status', 'Active')->get();

        $data = Product::with('images')->find($id);
        $date = [
            'data' => $data,
            'categories' => $categories,
            'writers' => $writers,
            'brands' => $brands,
            'merchants' => $merchants,
        ];
        return view($this->ROUTE_AND_VIEW . 'edit', $date);
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'type' => 'required|in:Book,General',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'merchant_id' => 'nullable|exists:merchants,id',
            'writer_id' => 'nullable|exists:writers,id',
            'code' => 'required|max:30',
            'name' => 'required|max:256',
            'buy_price' => 'required|numeric|between:0,999999.99',
            'price' => 'required|numeric|between:0,999999.99',
            'discount_type' => 'nullable|in:Taka,Percentage',
            'stock' => 'required|numeric|between:0,5000',
            'point' => 'required|numeric|between:0,1000',
            /*'shipping_in_dhaka'  => 'required|numeric|between:0,999999.99',
            'shipping_out_dhaka' => 'required|numeric|between:0,999999.99',*/
            'status' => 'required|in:Active,Inactive',
            'feature' => 'required|in:Yes,No',
        ]);

        $data = Product::find($id);

        if ($data) {
            //            $slug = uniqid().'-'. Str::slug($request->name);

            $image = '';
            if ($request->has('image')) {
                if ($data->image) {
                    $this->mediaDelete($this->ASSET_PATH, $data->image, '');
                }
                $image = $this->imageUpload($request->image, $this->ASSET_PATH, '', '');
            }

            if ($request->size) {
                $size = explode(',', $request->size);
            }

            if ($request->color) {
                $color = json_encode(explode(',', $request->color));
            }

            if ($request->fabrics) {
                $fabrics = json_encode(explode(',', $request->fabrics));
            }

            $data->update([
                'type' => $request->type,
                //                'slug'               => $slug,
                'category_id' => $request->category_id ?? 0,
                'brand_id' => $request->brand_id ?? 0,
                'merchant_id' => $request->merchant_id ?? 0,
                'code' => $request->code,
                'name' => $request->name,
                'buy_price' => $request->buy_price,
                'price' => $request->price,
                'discount_type' => $request->discount_type ?? null,
                'discount_value' => $request->discount_value ?? 0,
                'point' => $request->point,
                'stock' => $request->stock,
                /* 'shipping_in_dhaka'  => $request->shipping_in_dhaka,
                 'shipping_out_dhaka' => $request->shipping_out_dhaka,*/
                'writer_id' => $request->writer_id ?? 0,
                'first_release' => $request->first_release,
                'language' => $request->language,
                'size' => $size ?? $data->size,
                'color' => $color ?? $data->color,
                'fabrics' => $fabrics ?? $data->fabrics,
                'weight' => $request->weight,
                'warranty' => $request->warranty,
                'description' => $request->description,
                'delivery_info' => $request->delivery_info,
                'image' => $image ? $image['name'] : $data->image,
                'status' => $request->status,
                'feature' => $request->feature,
                'sort' => $request->sort,
            ]);

            if (!empty($request->product_images)) {
                $productImages = [];
                foreach ($request->product_images as $product_image) {
                    $imageInfo = $this->imageUpload($product_image, $this->ASSET_PATH . '/' . $data->id);
                    $productImages[] = [
                        'product_id' => $data->id,
                        'name' => $imageInfo['name'],
                        'url' => $imageInfo['url'],
                        'size' => $imageInfo['size'],
                    ];
                }
                ProductImage::insert($productImages);
            }
            return redirect(route($this->ROUTE_AND_VIEW . 'index'))->with('success', 'Product update successfully');
        } else {
            return redirect(route($this->ROUTE_AND_VIEW . 'index'))->with('warning', 'Something went wrong. Please try again !!');
        }
    }

    public function destroy(string $id)
    {
        $data = Product::find($id);
        if ($data) {
            if ($data->image) {
                $this->mediaDelete($this->ASSET_PATH, $data->image, '');
            }
            $this->removeDir($this->ASSET_PATH . '/' . $data->id);
            $data->delete();
            return redirect(route($this->ROUTE_AND_VIEW . 'index'))->with('success', 'Product delete successfully');
        } else {
            return redirect(route($this->ROUTE_AND_VIEW . 'index'))->with('warning', 'Something went wrong. Please try again !!');
        }
    }

    public function imageDelete($imageId)
    {
        $data = ProductImage::find($imageId);

        if ($data) {
            $this->mediaDelete($this->ASSET_PATH . '/' . $data->product_id, $data->name, '');
            $data->delete();

            return redirect()->back()->with('success', 'Product image delete successfully');
        } else {
            return redirect()->back()->with('warning', 'Something went wrong. Please try again !!');
        }
    }


    public function sortable(Request $request)
    {
        try {
            $solutions = Product::all();
            foreach ($solutions as $solution) {
                $solution->timestamps = false; // To disable update_at field updation
                $id = $solution->id;
                foreach ($request->order as $order) {
                    if ($order['id'] == $id) {
                        $solution->update(['sort' => $order['position']]);
                    }
                }
            }
            return response()->json([
                'status' => true,
                'message' => 'Update successfully'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }
}
