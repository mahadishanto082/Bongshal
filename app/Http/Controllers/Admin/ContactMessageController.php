<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $sql = ContactMessage::orderBy('created_at', 'DESC');

        if ($request->key) {
            $sql->where('name', 'like', '%' . $request->key . '%');
            $sql->orWhere('email', 'like', '%' . $request->key . '%');
            $sql->orWhere('mobile', 'like', '%' . $request->key . '%');
        }
        $messages = $sql->paginate(15);
        return view('admin.contact_message', compact('messages'));
    }

    public function destroy($id)
    {
        ContactMessage::find($id)->delete();
        return redirect()->back()->with('success', 'Message delete successfully');
    }
}
