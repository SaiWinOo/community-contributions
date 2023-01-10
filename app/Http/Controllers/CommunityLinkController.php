<?php

namespace App\Http\Controllers;

use App\Exceptions\CommunityLinkAlreadySubmitted;
use App\Models\Channel;
use App\Models\CommunityLinks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommunityLinkController extends Controller
{
    public function index(Channel $channel = null)
    {
        $channels = Channel::orderBy('title', 'asc')->get();
        $orderBy = request()->exists('popular') === true  ? 'votes_count': 'updated_at' ;
        $links = CommunityLinks::withCount('votes')->with('votes', 'creator')
            ->forChannel($channel)
            ->where('approved', 1)
            ->orderBy($orderBy, 'desc')
            ->paginate(3)
            ->withQueryString();
        return view('Community.index', compact('links', 'channels', 'channel'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'channel_id' => 'required|exists:channels,id',
            'title' => 'required',
            'link' => 'required|url',
        ]);


        try {
            CommunityLinks::from(Auth::user())->contribute($request->all());

            if (auth()->user()->isTrusted()) {
                Session::flash('success', 'Thanks for the contribution!');
            } else {
                Session::flash('success', 'Thanks, Your contribution will be approved shortly!');
            }

        } catch (CommunityLinkAlreadySubmitted $e) {
            Session::flash('success', "The link has already been submitted. We'll bring it to the top instead!");
        }

        return back();
    }
}

