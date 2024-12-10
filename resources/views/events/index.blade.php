@extends('layouts.app')
@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            @include('partials.errors')
            @include('partials.messages')

            <div class="mb-4 d-flex justify-content-between" role="group">
                <button class="btn btn-primary" onclick="showEventsList('organizer')">Own Events</button>
                <div>
                    <a class="btn btn-success" href="{{route('events.create')}}">Create new event</a>
                </div>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Event Categories
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach($categories as $category)
                            <li><button class="dropdown-item"
                                    onclick="showEventsList('{{ strtolower($category->name) }}')">{{ $category->name }}</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div id="organizer_events_table"
                style="{{ $currentCategory == 'organizer' ? 'display: block;' : 'display: none;' }}">
                @include('partials.events.events_table', ['events' => $events, 'category_name' => 'Organizer'])
            </div>

            @foreach($categories as $category)
                <div id="{{ strtolower($category->name) }}_events_table"
                    style="{{ $currentCategory == strtolower($category->name) ? 'display: block;' : 'display: none;' }}">
                    @include('partials.events.events_table', ['events' => $events, 'category_name' => $category->name])
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function showEventsList(listType) {
        const url = new URL(window.location.href);
        url.searchParams.set('category', listType);
        url.searchParams.set('page', 1);
        window.location.href = url.toString();
    }

    function handleDeleteEvent(event) {
        event.preventDefault();

        const button = event.currentTarget;
        const eventId = button.getAttribute('data-id');
        const eventName = button.getAttribute('data-name');

        let confirmation = confirm(
            `Are you sure you want to delete the event:\n\n ${eventName}?`);

        if (confirmation) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `{{ route('events.destroy', ['event' => '__eventId__']) }}`.replace('__eventId__', eventId);
            form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
@endsection