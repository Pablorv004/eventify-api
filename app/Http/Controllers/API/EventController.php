<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Resources\EventResource;
use Validator;
use App\Models\Event;
use App\Rules\ValidEvent;
use App\Models\Category;

class EventController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return $this->sendResponse(EventResource::collection($events), 'Events retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = $this->validateEvent($input);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $imageName = $this->handleImageUpload($request);

        $event = new Event();
        $event->fill($request->only([
            'title',
            'description',
            'category_id',
            'location',
            'start_date',
            'end_date',
            'latitude',
            'longitude',
            'max_attendees',
            'price'
        ]));
        $event->image_url = $imageName;
        $event->save();

        return $this->sendResponse(new EventResource($event), 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $event = Event::find($id);
        return $this->sendResponse(new EventResource($event), 'Event retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $event = Event::find($id);
        $input = $request->all();
        $validator = $this->validateEvent($input);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $imageName = $this->handleImageUpload($request, $event->id) ?? $event->image_url;

        $event->fill($request->only([
            'title',
            'description',
            'category_id',
            'location',
            'start_date',
            'end_date',
            'latitude',
            'longitude',
            'max_attendees',
            'price'
        ]));
        $event->image_url = $imageName;
        $event->save();

        return $this->sendResponse([], 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $event = Event::find($id);
        $event->delete();
        return $this->sendResponse([], 'Event deleted successfully.');
    }

    private function validateEvent($input)
    {
        return Validator::make($input, [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'max_attendees' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|string|max:2048',
        ]);
    }

    private function handleImageUpload(Request $request, $eventId = null)
    {
        if ($request->hasFile('image_file')) {
            $image = $request->file('image_file');
            $imageName = 'event-image-' . ($eventId ?? time()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/events'), $imageName);
            return $imageName;
        }
        return null;
    }
}
