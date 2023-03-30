<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\TweetComment;
use App\Notifications\TweetComment as NotificationsTweetComment;
use Illuminate\Http\Request;

class TweetCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $tweets = Tweet::find($id);
        $comments = new TweetComment();
        $comments->text = $request->text;
        $comments->user_id = auth()->user()->id;
        $comments->tweet_id = $id;
        $comments->save();
        $tweets->user->notify(new NotificationsTweetComment($comments));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comments = TweetComment::find($id);
        $tweets = Tweet::find($id);
        $this->authorize('edit', $comments);
        return view('comments.edit', compact('comments', 'tweets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comments = TweetComment::find($id);
        $comments->text = $request->text;
        $comments->save();
        return redirect()->route('tweets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comments = TweetComment::find($id);
        $this->authorize('destroy', $comments);
        $comments->delete();
        return redirect()->back();
    }
}
