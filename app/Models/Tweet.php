<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'content', 'media_url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Likes::class);
    }

    public function retweets()
    {
        return $this->hasMany(Retweet::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Example method to get the number of likes on a tweet
    public function likeCount()
    {
        return $this->likes->count();
    }

    // Example method to check if the authenticated user has liked the tweet
    public function isLikedByUser($user)
    {
        return $this->likes->where('user_id', $user->id)->count() > 0;
    }

    // Example method to get the retweet count
    public function retweetCount()
    {
        return $this->retweets->count();
    }

    // Example method to check if the authenticated user has retweeted the tweet
    public function isRetweetedByUser($user)
    {
        return $this->retweets->where('user_id', $user->id)->count() > 0;
    }
}
