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
        $api = new APIEventController();
        $eventsResponse = $api->index();
        $events = json_decode($eventsResponse->getContent())->data;
        $events = collect($events)->map(function ($eventData) {
            return new Event((array) $eventData);
        });
        $currentCategory = $request->input('category', 'organizer');
        $page = $request->input('page', 1);
        if ($currentCategory == 'organizer') {
            $events = Event::where('organizer_id', Auth::user()->id)->where('deleted', 0)->paginate(5, ['*'], 'page', $page);
        } else {
            $category = Category::where('name', ucfirst($currentCategory))->first();
            if ($category) {
                $events = Event::where('category_id', $category->id)->where('deleted', 0)->paginate(5, ['*'], 'page', $page);
            } else {
                $events = collect();
            }
        }
        $categories = Category::all();
        return view('events.index')->with('events', $events)->with('categories', $categories)->with('currentCategory', $currentCategory);
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
        //
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
