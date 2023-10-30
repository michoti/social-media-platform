<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Tweet;

class CommentController extends Controller
{
    public function store(Request $request, Tweet $tweet)
    {
        // Store a new comment for the specified tweet
        $request->validate([
            'content' => 'required|max:280',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'tweet_id' => $tweet->id,
            'content' => $request->input('content'),
        ]);

        return back(); // Redirect back to the tweet
    }

    public function edit(Comment $comment)
    {
        // Display a form to edit a comment (if the user has the right permissions)
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        // Update an existing comment (if the user has the right permissions)
        $request->validate([
            'content' => 'required|max:280',
        ]);

        $comment->update([
            'content' => $request->input('content'),
        ]);

        return redirect()->route('tweets.show', $comment->tweet);
    }

    public function destroy(Comment $comment)
    {
        // Delete a comment (if the user has the right permissions)
        $comment->delete();

        return back(); // Redirect back to the tweet
    }
}
