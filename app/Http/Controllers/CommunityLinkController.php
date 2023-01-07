<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\CommunityLinks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommunityLinkController extends Controller
{
    public function index()
    {
        Session::flash('success','This is success');
        $channels = Channel::orderBy('title', 'asc')->get();
        $links = CommunityLinks::where('approved', 1)->latest()->get();
        return view('Community.index', compact('links', 'channels'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'channel_id' => 'required|exists:channels,id',
            'title' => 'required',
            'link' => 'required|unique:community_links',
        ]);
        CommunityLinks::from(Auth::user())->attribute($request->all());

        return back();
    }
}
