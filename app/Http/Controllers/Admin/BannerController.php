<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Traits\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    use Media;

    protected $ASSET_PATH = 'banner';
    protected $ROUTE_AND_VIEW = 'admin.banner.';

    public function index()
    {
        $banners = Banner::paginate(15);
        $data = [
            'banners' => $banners
        ];
        return view($this->ROUTE_AND_VIEW . 'index', $data);
    }

    public function create()
    {
        return view($this->ROUTE_AND_VIEW . 'create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'  => 'nullable|string|max:255',
            'image'  => 'required',
            'link'   => 'nullable|url|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        $image = '';
        if ($request->has('image')) {
            $image = $this->imageUpload($request->image, $this->ASSET_PATH, '', '');
        }

        Banner::create([
            'title'      => $request->title,
            'image'      => $image ? $image['name'] : null,
            'link'       => $request->link,
            'status'     => $request->status,
            'created_by' => Auth::user()->name ?? Auth::id(),
        ]);

        return redirect(route($this->ROUTE_AND_VIEW . 'index'))->with('success', 'Banner created successfully');
    }

    public function edit(string $id)
    {
        $data = Banner::findOrFail($id);
        return view($this->ROUTE_AND_VIEW . 'edit', ['data' => $data]);
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title'  => 'nullable|string|max:255',
            'image'  => 'nullable',
            'link'   => 'nullable|url|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        $data = Banner::find($id);

        if ($data) {
            $image = '';
            if ($request->has('image')) {
                if ($data->image) {
                    $this->mediaDelete($this->ASSET_PATH, $data->image, '');
                }
                $image = $this->imageUpload($request->image, $this->ASSET_PATH, '', '');
            }

            $data->update([
                'title'  => $request->title,
                'image'  => $image ? $image['name'] : $data->image,
                'link'   => $request->link,
                'status' => $request->status,
            ]);

            return redirect(route($this->ROUTE_AND_VIEW . 'index'))->with('success', 'Banner updated successfully');
        } else {
            return redirect(route($this->ROUTE_AND_VIEW . 'index'))->with('warning', 'Something went wrong. Please try again !!');
        }
    }

    public function destroy(string $id)
    {
        $data = Banner::find($id);

        if ($data) {
            if ($data->image) {
                $this->mediaDelete($this->ASSET_PATH, $data->image, '');
            }
            $data->update(['deleted_by' => Auth::user()->name ?? Auth::id()]);
            $data->delete();
            return redirect(route($this->ROUTE_AND_VIEW . 'index'))->with('success', 'Banner deleted successfully');
        } else {
            return redirect(route($this->ROUTE_AND_VIEW . 'index'))->with('warning', 'Something went wrong. Please try again !!');
        }
    }
}