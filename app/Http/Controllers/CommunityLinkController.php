<?php

namespace App\Http\Controllers;

use App\Models\CommunityLinks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityLinkController extends Controller
{
    public function index()
    {
        $links = CommunityLinks::latest()->get();
        return view('Community.index',compact('links'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'title' => 'required',
           'link' => 'required|active_url',
        ]);
        CommunityLinks::from(Auth::user())->attribute($request->all());
        return back();
    }
}
