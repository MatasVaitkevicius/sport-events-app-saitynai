<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('auth.role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function index(Type $type)
    {
        return $type->events()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Type $type)
    {
        $validated = $request->validate([
            'name' => 'required|max:50|string',
            'description' => 'required|string',
        ]);

        return $type->events()->create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type, Event $event)
    {
        return $type->events()->findOrFail($event->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|max:50|string',
            'description' => 'required|string',
        ]);

        $event->update($validated);

        return $event;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type, Event $event)
    {
        if ($event->delete()) {
            return response('', 204);
        }
    }
}
