<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class TweetController extends Controller
{
    public function index()
    {
        // Retrieve and display a list of tweets
        // $tweets = auth()->user()->following ? auth()->user()->following->load('tweets') : Tweet::latest()->get();
        $tweets = Tweet::latest()->get();
        return view('tweets.index', compact('tweets'));
    }

    public function create()
    {
        // Display a form to create a new tweet
        return view('tweets.create');
    }

    public function store(Request $request)
    {
        // Store a new tweet in the database
        $request->validate([
            'content' => 'required|max:280',
        ]);

        Tweet::create([
            'user_id' => auth()->user()->id,
            'content' => $request->input('content'),
        ]);

        return redirect()->route('tweets.index');
    }

    public function show(Tweet $tweet)
    {
        // Display a single tweet
        return view('tweets.show', compact('tweet'));
    }

    public function edit(Tweet $tweet)
    {
        // Display a form to edit a tweet (if the user has the right permissions)
        return view('tweets.edit', compact('tweet'));
    }

    public function update(Request $request, Tweet $tweet)
    {
        // Update an existing tweet (if the user has the right permissions)
        $request->validate([
            'content' => 'required|max:280',
        ]);

        $tweet->update([
            'content' => $request->input('content'),
        ]);

        return redirect()->route('tweets.show', $tweet);
    }

    public function destroy(Tweet $tweet)
    {
        // Delete a tweet (if the user has the right permissions)
        $tweet->delete();
        return redirect()->route('tweets.index');
    }
}
