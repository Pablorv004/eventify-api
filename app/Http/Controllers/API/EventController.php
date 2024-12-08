<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Resources\EventResource;
use Validator;
use App\Models\Event;
use App\Models\Category;

class EventController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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
        // Values that we want to update
        $validator = Validator::make($input, [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|numeric',
            // 'start_date' => 'required|date',
            // 'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'max_attendees' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|string|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // Image handling
        $imageName = null;

        if ($request->hasFile('image_file')) {
            $image = $request->file('image_file');
            $imageName = 'event-image-' . $event->id . '.' . $image->getClientOriginalExtension();

            // Save image to public/images/events
            $image->move(public_path('images/events'), $imageName);
        } else {
            // Maintain image if no new image is uploaded
            $imageName = $event->image_url;
        }

        // Event update
        $event->fill($request->only([
            'title',
            'description',
            'category_id',
            'location',
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
    public function destroy(Event $event)
    {
        //
    }
}
