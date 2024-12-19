<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Event;
use App\Http\Controllers\API\EventController as APIEventController;
use Illuminate\Support\Facades\Auth;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $events = Event::all();

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Event $event = null)
    {
        $categories = Category::all();
        return view('events.form', compact('categories', 'event'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $api = new APIEventController();
        $response = $api->store($request);

        if ($response->getData()->success == 'success') {
            return redirect('/events')->with('success', 'Event created successfully');
        } else {
            $errorMessage = json_decode($response->getContent())->message ?? 'Failed to create event. Please check all parameters and try again.';
            return redirect()->back()->withErrors($response->getData()->message);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $categories = Category::all();
        return view('events.form', compact('categories', 'event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $api = new APIEventController();
        $response = $api->update($request, $id);
        
        if ($response->getData()->success == 'success') {
            return redirect('/events')->with('success', 'Event updated successfully');
        } else {
            $errorMessage = json_decode($response->getContent())->message ?? 'Failed to update event. Please check all parameters and try again.';
            return redirect()->back()->withErrors($response->getData()->message);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $api = new APIEventController();
        $api->destroy($event->id);
        return back()->with('success', 'Event deleted successfully');
    }
}
