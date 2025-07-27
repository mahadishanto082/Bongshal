<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    protected $ASSET_PATH = 'banners';
    protected $ROUTE_AND_VIEW = 'admin.banner.'; // use lowercase if your folder is lowercase

    public function index()
    {
        $banners = Banner::paginate(15);
        return view($this->ROUTE_AND_VIEW . 'index', ['banners' => $banners]);
    }

    public function create()
    {
        return view($this->ROUTE_AND_VIEW . 'create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:Active,Inactive',
        ]);

        $imagePath = $request->file('image')->store($this->ASSET_PATH, 'public');

        Banner::create([
            'title' => $request->title,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route($this->ROUTE_AND_VIEW . 'index')->with('success', 'Banner created successfully.');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view($this->ROUTE_AND_VIEW . 'edit', ['banner' => $banner]);
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:Active,Inactive',
        ]);

        if ($request->hasFile('image')) {
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }
            $banner->image = $request->file('image')->store($this->ASSET_PATH, 'public');
        }

        $banner->title = $request->title;
        $banner->status = $request->status;
        $banner->save();

        
        return redirect()->route('admin.banners.index')
        ->with('success', ' updated successfully');}

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        if ($banner->image) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()->route('admin.banners.index')
        ->with('success', ' updated successfully');}}

