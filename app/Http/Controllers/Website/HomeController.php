<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Slider;
use App\Models\User;
use App\Services\HomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    private HomeService $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index()
    {
        $data = [
            'sliders' => $this->homeService->getAllSliders(),
            'feature_categories' => $this->homeService->featureCategoryWithProducts(),
            'categories' => $this->homeService->getAllCategories(),
            'new_arrival_products' => $this->homeService->newArrivalProducts(),
        ];

        return view('website.home', $data);
    }

    public function categories ()
    {
        $data = [
            'categories' => $this->homeService->getAllCategories(),
        ];

        return view('website.categories', $data);
    }

    public function categoryByProducts($categorySlug)
    {
        $data = $this->homeService->getProductsByCategory($categorySlug);
        return view('website.category_products', $data);
    }

    public function contactUs()
    {
        return view('website.contact_us');
    }

    public function contactMessage(Request $request)
    {
        $this->validate($request, [
            'name'       => 'required|max:256',
            'mobile'     => 'required|string|max:15',
            'message'     => 'nullable|string|max:300',
        ]);

        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Thank You for your message. We will contact you very soon.');
    }

    public function checkReference(Request $request)
    {
        $ref = Str::upper($request->reference_code);
        $agent = User::where('reference', $ref)->where('role', 'Agent')
            ->where('status', 'Active')
            ->first();

        if ($agent) {
            if (auth('web')->id() == $agent->id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Please use others reference. Own reference not allowed'
                ]);
            }
            return response()->json([
                'status' => true,
                'message' => 'Thank you use reference. You got free shipping.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Opps! This is wrong reference code.'
            ]);
        }

    }
}
