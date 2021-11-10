<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Event;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Type  $type
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function index(Type $type, Event $event)
    {
        return $event->comments()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Type $type, Event $event)
    {
        $validated = $request->validate([
            'content' => 'required|max:200|string',
        ]);

        return $event->comments()->create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @param  \App\Models\Event  $event
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type, Event $event, Comment $comment)
    {
        return $event->comments()->findOrFail($comment->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @param  \App\Models\Event  $event
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type, Event $event, Comment $comment)
    {
        $validated = $request->validate([
            'content' => 'required|max:200|string',
        ]);

        $comment->update($validated);

        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @param  \App\Models\Event  $event
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type, Event $event, Comment $comment)
    {
        if ($comment->delete()) {
            return response('', 204);
        }
    }
}
