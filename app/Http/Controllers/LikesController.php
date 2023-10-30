<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use Illuminate\Http\Request;
use App\Models\Tweet;

class TweetLikesController extends Controller
{
    public function store(Tweet $tweet)
    {   
        if($tweet->isLikedBy(auth()->user())) {
            Likes::where('tweet_id', $tweet->id)->where('user_id', auth()->user()->id)->delete();
        }else {
            $tweet->like(auth()->user());
        }
        return back();
    }

    public function destroy(Tweet $tweet)
    {
        if($tweet->isDislikedBy(auth()->user())) {
            Likes::where('tweet_id', $tweet->id)->where('user_id', auth()->user()->id)->delete();
        }else {
            $tweet->dislike(auth()->user());
        }
        return back();
    }
}