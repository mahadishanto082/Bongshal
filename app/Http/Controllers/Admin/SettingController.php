<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\Media;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use Media;
    protected $ASSET_PATH = 'logo';

    public function index()
    {
        $setting = Setting::first();
        return view('admin.setting', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first();

        $logo = '';
        if ($request->has('logo')) {
            if ($setting && $setting->logo) {
                $this->mediaDelete($this->ASSET_PATH, $setting->logo, '');
            }
            $logo = $this->imageUpload($request->logo, $this->ASSET_PATH);
            $logo = $logo['name'];
        } else {
            if ($setting && $setting->logo) {
                $logo = $setting->logo;
            }
        }

        $data = [
            'title'                 => $request->title,
            'address'               => $request->address,
            'email'                 => $request->email,
            'email_2'               => $request->email_2,
            'mobile'                => $request->mobile,
            'mobile_2'              => $request->mobile_2,
            'facebook'              => $request->facebook,
            'instagram'             => $request->instagram,
            'linkedin'              => $request->linkedin,
            'youtube'               => $request->youtube,
            'twitter'               => $request->twitter,
            'logo'                  => $logo,
            'shipping_in_dhaka'     => $request->shipping_in_dhaka,
            'shipping_out_dhaka'    => $request->shipping_out_dhaka,
        ];

        if ($setting) {
            $setting->update($data);
        } else {
            Setting::insert($data);
        }
        return redirect()->back()->with('success', 'Setting update successfully.');
    }
}
