<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CommunityLinks extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'title', 'link', 'channel_id'];


    public static function from(User $user)
    {
        $link = new static;
        $link->user_id = Auth::id();
        if($user->isTrusted()){
            $link->approved();
        }
        return $link;
    }

    public function approved()
    {
         $this->approved = true;
    }

    public function attribute($attributes)
    {
        return $this->fill($attributes)->save();
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

}
