<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Traits\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    use Media;
    protected $ASSET_PATH = 'brands';
    protected $ROUTE_AND_VIEW = 'admin.brands.';

    public function index()
    {
        $brands = Brand::paginate(15);
        $date = [
            'brands' => $brands
        ];
        return view($this->ROUTE_AND_VIEW.'index', $date);
    }

    public function create()
    {
        return view($this->ROUTE_AND_VIEW.'create');
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

        Brand::create([
            'slug'        => $slug,
            'name'        => $request->name,
            'description' => $request->description,
            'image'       => $image ? $image['name'] : null,
            'status'      => $request->status,
            'feature'     => $request->feature,
        ]);

        return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('success', 'Brand create successfully');
    }

    public function edit(string $id)
    {
        $data = Brand::find($id);
        $date = [
            'data' => $data
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

        $data = Brand::find($id);

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
                'name'        => $request->name,
                'description' => $request->description,
                'image'       => $image ? $image['name'] : $data->image,
                'status'      => $request->status,
                'feature'     => $request->feature,
            ]);

            return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('success', 'Brand update successfully');
        } else {
            return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('warning', 'Something went wrong. Please try again !!');
        }
    }

    public function destroy(string $id)
    {
        $data = Brand::find($id);
        if ($data) {
            if ($data->image) {
                $this->mediaDelete($this->ASSET_PATH, $data->image, '');
            }
            $data->delete();
            return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('success', 'Brand delete successfully');
        } else {
            return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('warning', 'Something went wrong. Please try again !!');
        }
    }
}
