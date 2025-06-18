<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    use Media;
    protected $ASSET_PATH = 'categories';
    protected $ROUTE_AND_VIEW = 'admin.categories.';

    public function index()
    {
        $categories = Category::with('parent')->paginate(15);
        $date = [
            'categories' => $categories
        ];
        return view($this->ROUTE_AND_VIEW.'index', $date);
    }

    public function create()
    {
        $categories = Category::where('status', 'Active')->where('parent_id', 0)->get();
        $date = [
            'categories' => $categories
        ];
        return view($this->ROUTE_AND_VIEW.'create', $date);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'       => 'required|max:256',
            'status'     => 'required|in:Active,Inactive',
            'feature'    => 'required|in:Yes,No',
        ]);

        $slug = uniqid().'-'. Str::slug($request->name);

        $image = '';
        if ($request->has('image')) {
            $image = $this->imageUpload($request->image, $this->ASSET_PATH, '', '', [300, 300]);
        }

        Category::create([
            'slug'        => $slug,
            'parent_id'   => $request->parent ?? 0,
            'name'        => $request->name,
            'description' => $request->description,
            'image'       => $image ? $image['name'] : null,
            'status'      => $request->status,
            'feature'     => $request->feature,
        ]);

        return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('success', 'Category create successfully');
    }

    public function edit(string $id)
    {
        $categories = Category::where('status', 'Active')
            ->where('id', '!=', $id)
            ->where('parent_id', 0)->get();
        $data = Category::find($id);
        $date = [
            'data' => $data,
            'categories' => $categories
        ];
        return view($this->ROUTE_AND_VIEW.'edit', $date);
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name'       => 'required|max:256',
            'status'     => 'required|in:Active,Inactive',
            'feature'    => 'required|in:Yes,No',
        ]);

        $data = Category::find($id);

        if ($data) {
            $slug = uniqid().'-'. Str::slug($request->name);

            $image = '';
            if ($request->has('image')) {
                if ($data->image) {
                    $this->mediaDelete($this->ASSET_PATH, $data->image, '');
                }
                $image = $this->imageUpload($request->image, $this->ASSET_PATH, '', '', [300, 300]);
            }

            $data->update([
                'slug'        => $slug,
                'parent_id'   => $request->parent ?? 0,
                'name'        => $request->name,
                'description' => $request->description,
                'image'       => $image ? $image['name'] : $data->image,
                'status'      => $request->status,
                'feature'     => $request->feature,
            ]);

            return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('success', 'Category update successfully');
        } else {
            return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('warning', 'Something went wrong. Please try again !!');
        }
    }

    public function destroy(string $id)
    {
        $data = Category::find($id);
        if ($data) {
            if ($data->image) {
                $this->mediaDelete($this->ASSET_PATH, $data->image, '');
            }
            $data->delete();
            return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('success', 'Category delete successfully');
        } else {
            return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('warning', 'Something went wrong. Please try again !!');
        }
    }
}
