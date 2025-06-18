<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Writer;
use App\Traits\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WriterController extends Controller
{
    use Media;
    protected $ASSET_PATH = 'writers';
    protected $ROUTE_AND_VIEW = 'admin.writers.';

    public function index()
    {
        $writers = Writer::paginate(15);
        $date = [
            'writers' => $writers
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

        Writer::create([
            'slug'        => $slug,
            'name'        => $request->name,
            'bio'         => $request->bio,
            'image'       => $image ? $image['name'] : null,
            'status'      => $request->status,
            'feature'     => $request->feature,
        ]);

        return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('success', 'Writer create successfully');
    }

    public function edit(string $id)
    {
        $data = Writer::find($id);
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

        $data = Writer::find($id);

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
                'bio'         => $request->bio,
                'image'       => $image ? $image['name'] : $data->image,
                'status'      => $request->status,
                'feature'     => $request->feature,
            ]);

            return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('success', 'Writer update successfully');
        } else {
            return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('warning', 'Something went wrong. Please try again !!');
        }
    }

    public function destroy(string $id)
    {
        $data = Writer::find($id);
        if ($data) {
            if ($data->image) {
                $this->mediaDelete($this->ASSET_PATH, $data->image, '');
            }
            $data->delete();
            return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('success', 'Writer delete successfully');
        } else {
            return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('warning', 'Something went wrong. Please try again !!');
        }
    }
}
