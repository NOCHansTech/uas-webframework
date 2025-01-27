<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $links = Link::where('original_url', 'like', '%' . $search . '%')
                ->orWhere('title', 'like', '%' . $search . '%')
                ->where('users_id', Auth::user()->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $links = Link::orderBy('created_at', 'desc')
            ->where('users_id', Auth::user()->id)
            ->paginate(10);
        }
        return view('page.dashboard', compact('links', 'search'));
    }

    public function linkList(Request $request){

        $search = $request->input('search');
        if ($search) {
            $links = Link::where('original_url', 'like', '%' . $search . '%')
                ->orWhere('title', 'like', '%' . $search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $links = Link::orderBy('created_at', 'desc')->paginate(9);
        }
        return view('page.shortlist', compact('links', 'search'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
            'title' => 'nullable|max:200'
        ]);

        $shortenedUrl = Str::random(4);

        $link = Link::create([
            'users_id' => Auth::user()->id,
            'original_url' => $request->original_url,
            'shortened_url' => $shortenedUrl,
            'title' => $request->title,
        ]);
        return redirect()->back()->with('success', 'URL berhasil di singkatkan!');
    }

    public function show($id)
    {
        $link = Link::findOrFail($id); 
        return response()->json($link);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'original_url' => 'required|url',
            'title' => 'nullable|string|max:200',
        ]);

        $link = Link::findOrFail($id);
        $link->original_url = $request->original_url;
        $link->title = $request->title;
        $link->save();
        session()->flash('success', 'Link URL Berhasil di perbarui.');
        return response()->json($link);
    }


    public function destroy($id)
    {
        $link = Link::findOrFail($id);
        $link->delete();

        return redirect()->route('dashboard')->with('success', 'URL berhasil dihapus!');
    }

    public function redirectToOriginal($shortenedUrl)
    {
        $link = Link::where('shortened_url', $shortenedUrl)->first();
        if ($link) {
            $link->increment('click');
            return redirect($link->original_url,302);
        }else{
            return view('errors.linkfail');
        }
        // return response()->json(['error' => 'URL not found'], 404);
    }
}
