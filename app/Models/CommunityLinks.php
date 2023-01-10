<?php

namespace App\Models;

use App\Exceptions\CommunityLinkAlreadySubmitted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommunityLinks extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'link', 'channel_id'];

    public function scopeForChannel($query, $channel)
    {
        if ($channel) {
            return $query->where('channel_id', $channel->id);
        }
        return $query;
    }

    public static function from(User $user)
    {
        $link = new static;
        $link->user_id = Auth::id();
        if ($user->isTrusted()) {
            $link->approve();
        }
        return $link;
    }

    public function approve()
    {
        $this->approved = true;
    }

    public function contribute($attributes)
    {
        if ($existing = $this->hasAlreadyBeenSubmitted($attributes['link'])) {
            $existing->touch();
            throw new CommunityLinkAlreadySubmitted();
        }
        return $this->fill($attributes)->save();

    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    protected function hasAlreadyBeenSubmitted($link)
    {
        return static::where('link', $link)->first();
    }

    public function votes()
    {
        return $this->hasMany(CommunityLinksVotes::class, 'community_link_id');
    }
}
