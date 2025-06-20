<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\PasswordUpdateRequest;
use App\Http\Requests\Web\ProfileUpdateRequest;
use App\Models\Order;
use App\Models\User;
use App\Models\UserPoint;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Compare;
class UserController extends Controller
{
    /**
     * The UserService instance.
     *
     * @var UserService $userService
     */
    private UserService $userService;

    /**
     * Create a new controller instance.
     *
     * @param void
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function orders()
    {
        $result = $this->userService->orders();

        if ($result['success']) {
            return view('website.user.orders', $result['data']);
        } else {
            return redirect()
                ->back()
                ->withError($result['message']);
        }
    }
public function countWishlist(){
    
    $user = auth('web')->user();
    $wishlistCount = 0;
   

    if ($user) {
        $wishlistCount = Wishlist::where('user_id', $user->id)->count();
       
    }

    return view('website.wishlist', [
        'wishlist_count_total' => $wishlistCount,
       
    ]);
}
    /**
     * Display a listing of the resource.
     */
    public function wishlistItems()
    {
        $user = auth('web')->user();
        if($user){
            $wishlistItems = Wishlist::with('product')->where('user_id', auth()->id())->get();

            return view('website.user.wishlist', compact('wishlistItems'));
        }

        // return view('website.user.wishlist');
    }

    public function addTowishlist($id)
    {
        $user = auth('web')->user();
        if ($user) {
            $user->wishlist()->toggle($id);
            return redirect()->back()->with('success', 'Product added to wishlist successfully!');
        } else {
            return redirect()->back()->with('error', 'You need to login first!');
        }
    }

    public function removeWishlist($id)
{
    $user = auth('web')->user();

    if ($user) {
        $wishlistItem = Wishlist::where('user_id', $user->id)
                                ->where('product_id', $id)
                                ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            return redirect()->back()->with('success', 'Product removed from wishlist.');
        }
    }

    return redirect()->back()->with('error', 'Something went wrong.');
}
public function checkWishlist($id)
{
    $user = auth('web')->user();    

if ($user) {
        $wishlistItem = Wishlist::where('user_id', $user->id)
                                ->where('product_id', $id)
                                ->first();

        if ($wishlistItem) {
            return response()->json(['exists' => true]);
        }
    }
    return response()->json(['exists' => false]);
}


public function compare()
{
    $user = auth('web')->user();

    if ($user) {
        $compareItems = \App\Models\Compare::with('product')->where('user_id', $user->id)->get();
        return view('website.user.compare', compact('compareItems'));
    }

    return redirect()->route('home')->with('error', 'You must be logged in to view compare items.');
}
public function addToCompare()
{
    if (auth('web')->check()) {
        $user = auth('web')->user();
        $productId = $id;

        // Check if the product is already in the compare list
        $compareItem = Compare::where('user_id', $user->id)
                              ->where('product_id', $productId)
                              ->first();

        if (!$compareItem) {
            Compare::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
            return redirect()->back()->with('success', 'Product added to compare list successfully!');
        } else {
            return redirect()->back()->with('info', 'Product is already in your compare list.');
        }
    } else {
        return redirect()->back()->with('error', 'You need to login first!');
    }
}
public function removeCompare($id)
{
    $user = auth('web')->user();
    if ($user) {
        $compareItem = Compare::where('user_id', $user->id)
                              ->where('product_id', $id)
                              ->first();

        if ($compareItem) {
            $compareItem->delete();
            return redirect()->back()->with('success', 'Product removed from compare list.');
        }
    }
    return redirect()->back()->with('error', 'Something went wrong.');
}

    /**
     * Display a listing of the resource.
     */
    public function profile()
    {
        return view('website.user.profile');
    }
    /**
     * Display a listing of the resource.
     */
    public function pointHistory()
    {
        $points = UserPoint::with('product')->where('user_id', auth('web')->id())->latest()->paginate(20);
        return view('website.user.point-history', compact('points'));
    }

    public function withdrawRequest(Request $request)
    {
        $user = auth('web')->user();
        $this->validate($request, [
            'withdraw_point' => 'required|integer|min:100|max:'.$user->point,
            'type' => 'required|in:Bkash,Nagad,Recharge',
            'payment_number' => 'required|min:11|max:14',
        ]);

        UserPoint::create([
            'user_id' => $user->id,
            'point' => $request->withdraw_point,
            'type' => $request->type,
            'payment_number' => $request->payment_number,
            'flag' => 'Withdraw',
            'notes' => 'Point Withdraw',
        ]);

        User::find($user->id)->update([
            'point' => $user->point - $request->withdraw_point,
        ]);

        return redirect()->back()->with('success', 'Your withdraw request successfully!!');
    }

    /**
     * Update user's password.
     */
    public function passwordUpdate(PasswordUpdateRequest $request)
    {
        $result = $this->userService->passwordUpdate($request->validated());

        if ($result['success']) {
            return redirect()
                ->back()
                ->withSuccess('Password updated successfully.');
        } else {
            return redirect()
                ->back()
                ->withErrors(['password' => $result['message']]);
        }
    }

    /**
     * Update user's profile.
     */
    public function profileUpdate(ProfileUpdateRequest $request)
    {
        $result = $this->userService->profileUpdate($request->validated());

        if ($result['success']) {
            return redirect()
                ->back()
                ->withSuccess('Profile updated successfully.');
        } else {
            return redirect()
                ->back()
                ->withError($result['message']);
        }
    }

    /**
     * Cancel user's order.
     */
    public function cancelOrder(Order $order)
    {
        $result = $this->userService->cancelOrder($order);

        if ($result['success']) {
            return redirect()
                ->back()
                ->withSuccess('Order canceled successfully.');
        } else {
            return redirect()
                ->back()
                ->withError($result['message']);
        }
    }
}