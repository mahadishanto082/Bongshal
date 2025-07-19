<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use App\Traits\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    use Media;
    protected $ASSET_PATH = 'sliders';
    protected $ROUTE_AND_VIEW = 'admin.sliders.';

    public function index()
    {
        $sliders = Slider::with('category')->paginate(15);
        $date = [
            'sliders' => $sliders
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
            'image'      => 'required',
            'status'     => 'required|in:Active,Inactive',
        ]);

        $image = '';
        if ($request->has('image')) {
            $image = $this->imageUpload($request->image, $this->ASSET_PATH, '', '');
        }

        Slider::create([
            'category_id' => $request->category_id ?? 0,
            'title'       => $request->title,
            'sub_title'   => $request->sub_title,
            'description' => $request->description,
            'image'       => $image ? $image['name'] : null,
            'status'      => $request->status,
        ]);

        return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('success', 'Slider create successfully');
    }

    public function edit(string $id)
    {
        $categories = Category::where('status', 'Active')->where('parent_id', 0)->get();
        $data = Slider::find($id);
        $date = [
            'data' => $data,
            'categories' => $categories
        ];
        return view($this->ROUTE_AND_VIEW.'edit', $date);
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'image'      => 'nullable',
            'status'     => 'required|in:Active,Inactive',
        ]);

        $data = Slider::find($id);

        if ($data) {
            $slug = uniqid().'-'. Str::slug($request->name);

            $image = '';
            if ($request->has('image')) {
                if ($data->image) {
                    $this->mediaDelete($this->ASSET_PATH, $data->image, '');
                }
                $image = $this->imageUpload($request->image, $this->ASSET_PATH, '', '');
            }

            $data->update([
                'category_id' => $request->category_id ?? 0,
                'title'       => $request->title,
                'sub_title'   => $request->sub_title,
                'description' => $request->description,
                'image'       => $image ? $image['name'] : $data->image,
                'status'      => $request->status,
            ]);

            return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('success', 'Slider update successfully');
        } else {
            return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('warning', 'Something went wrong. Please try again !!');
        }
    }

    public function destroy(string $id)
    {
        $data = Slider::find($id);
        if ($data) {
            if ($data->image) {
                $this->mediaDelete($this->ASSET_PATH, $data->image, '');
            }
            $data->delete();
            return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('success', 'Slider delete successfully');
        } else {
            return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('warning', 'Something went wrong. Please try again !!');
        }
    }
}
