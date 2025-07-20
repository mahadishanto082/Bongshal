<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WelcomeText;
use Illuminate\Http\Request;

class WelcomeTextController extends Controller
{

    protected $ROUTE_AND_VIEW = 'admin.welcome-text.';
    


    public function index()
    {
        $welcomeTexts = WelcomeText::paginate(15);
        return view($this->ROUTE_AND_VIEW . 'index', ['welcomeTexts' => $welcomeTexts]);
    }

    public function create()
    {
        return view($this->ROUTE_AND_VIEW . 'create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        WelcomeText::create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.WelcomeTexts.index')
        ->with('success', 'Welcome text created successfully');
}

    public function edit(string $id)
    {
        $welcomeText = WelcomeText::findOrFail($id);
        return view($this->ROUTE_AND_VIEW . 'edit', ['welcomeText' => $welcomeText]);
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        $welcomeText = WelcomeText::findOrFail($id);
        $welcomeText->update([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.WelcomeTexts.index')
        ->with('success', 'Welcome text updated successfully');
    }

    public function destroy(string $id)
    {
        WelcomeText::destroy($id);
        return redirect()->route('admin.WelcomeTexts.index')

                         ->with('success', 'Welcome text deleted successfully');
    }
}
