<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPoint;
use App\Traits\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AgentController extends Controller
{
    use Media;
    protected $ASSET_PATH = 'users';
    protected $ROUTE_AND_VIEW = 'admin.agents.';

    public function index()
    {
        $agents = User::where('role', "Agent")->paginate(15);
        $date = [
            'agents' => $agents
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
            'email'      => 'required|string|email|max:255|unique:users',
            'mobile'     => 'required|string|max:15|unique:users',
            'reference'  => 'required|string|max:50|unique:users',
            'password'   => 'required|string|min:8|confirmed',
            'status'     => 'required|in:Active,Inactive',
            'image'      => 'nullable',
        ]);

        $image = '';
        if ($request->has('image')) {
            $image = $this->imageUpload($request->image, $this->ASSET_PATH, '', '', [300, 300]);
        }

        User::create([
            'role'              => "Agent",
            'name'              => $request->name,
            'email'             => $request->email,
            'mobile'            => $request->mobile,
            'password'          => Hash::make($request->password),
            'image'             => $image ? $image['name'] : null,
            'status'            => $request->status,
            'reference'         => $request->reference,
            'email_verified_at' => now()
        ]);

        return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('success', 'Agent create successfully');
    }

    public function edit(string $id)
    {
        $data = User::find($id);
        $date = [
            'data' => $data
        ];
        return view($this->ROUTE_AND_VIEW.'edit', $date);
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name'       => 'required|max:256',
            'email'      => 'required|string|email|max:255|unique:users,email,'.$id,
            'mobile'     => 'required|string|max:15|unique:users,mobile,'.$id,
            'reference'  => 'required|string|max:50|unique:users,reference,'.$id,
            'status'     => 'required|in:Active,Inactive',
            'image'      => 'nullable',
        ]);

        if ($request->password) {
            $this->validate($request, [
                'password'   => 'required|string|min:8|confirmed',
            ]);
        }


        $data = User::find($id);

        if ($data) {

            $image = '';
            if ($request->has('image')) {
                if ($data->image) {
                    $this->mediaDelete($this->ASSET_PATH, $data->image, '');
                }
                $image = $this->imageUpload($request->image, $this->ASSET_PATH, '', '', [300, 300]);
            }

            $data->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'mobile'    => $request->mobile,
                'password'  => $request->password ? Hash::make($request->password) : $data->password,
                'image'     => $image ? $image['name'] : null,
                'reference' => $request->reference,
                'status'    => $request->status,
            ]);

            return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('success', 'Agent update successfully');
        } else {
            return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('warning', 'Something went wrong. Please try again !!');
        }
    }

    public function destroy(string $id)
    {
        $data = User::find($id);
        if ($data) {
            if ($data->image) {
                $this->mediaDelete($this->ASSET_PATH, $data->image, '');
            }
            $data->delete();
            return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('success', 'Agent delete successfully');
        } else {
            return redirect(route($this->ROUTE_AND_VIEW.'index'))->with('warning', 'Something went wrong. Please try again !!');
        }
    }

    public function withdrawRequest(Request $request)
    {
        $sql = UserPoint::with('user')->where('flag', 'Withdraw');

        if ($request->status) {
            $sql->where('status', $request->status);
        } else {
            $sql->where('status', 'Pending');
        }

        $withdraws = $sql->orderBy('created_at', 'DESC')->paginate(15);
        return view($this->ROUTE_AND_VIEW.'withdraw-request', compact('withdraws'));
    }

    public function withdrawRequestUpdate(Request $request, $id)
    {
        $withdraw = UserPoint::find($id);
        if ($withdraw) {
            $withdraw->update(['status' => $request->status]);
            if ($withdraw->status == 'Failed') {
                $user = User::find($withdraw->user_id);
                $user->update([
                    'point' => $user->point + $withdraw->point
                ]);
            }
        }

        return redirect()->back()->with('success', 'Withdraw request update successfully.');
    }
}
