<?php

namespace App\Http\Controllers;

use App\Models\CommunityLinks;
use App\Models\CommunityLinksVotes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VotesController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function store(CommunityLinks $link)
    {
        CommunityLinksVotes::firstOrNew([
            'user_id' => Auth::id(),
            'community_link_id' => $link->id,
        ])->toggle();

        return back();
    }
}
