@extends('layouts.app')
@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            @include('partials.errors')
            @include('partials.messages')

            <div class="mb-4 d-flex justify-content-between" role="group">
                <div>
                    <a class="btn btn-success" href="{{route('events.create')}}">Create new event</a>
                </div>
            </div>

            <div>
                @include('partials.events.events_table', ['events' => $events, 'category_name' => 'Organizer'])
            </div>
        </div>
    </div>
</div>
@endsection