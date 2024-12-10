@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('partials.errors')
            @include('partials.messages')
            <div class="card">
                <div class="card-header">{{ $event ? __('Edit Event') : __('Create Event') }}</div>

                <div class="card-body">
                    <form method="POST"
                        action="{{ $event ? route('events.update', $event->id) : route('events.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @if($event)
                            @method('PUT')
                        @endif


                        <input id="organizer_id" type="text"
                            class="form-control @error('organizer_id') is-invalid @enderror" name="organizer_id"
                            value="{{ old('organizer_id', $event->organizer_id ?? Auth::id()) }}" hidden>

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" value="{{ old('title', $event->title ?? '') }}" required autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description"
                                class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                            <div class="col-md-6">
                                <textarea id="description"
                                    class="form-control @error('description') is-invalid @enderror" name="description"
                                    required>{{ old('description', $event->description ?? '') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="category_id"
                                class="col-md-4 col-form-label text-md-end">{{ __('Category') }}</label>
                            <div class="col-md-6">
                                <select id="category_id" class="form-control @error('category_id') is-invalid @enderror"
                                    name="category_id" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $event->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="start_date"
                                class="col-md-4 col-form-label text-md-end">{{ __('Start Date') }}</label>
                            <div class="col-md-6">
                                <input id="start_date" type="datetime-local"
                                    class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                                    value="{{ old('start_date', $event ? \Carbon\Carbon::parse($event->start_date)->format('Y-m-d\TH:i') : '') }}"
                                    required>
                                @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="end_date"
                                class="col-md-4 col-form-label text-md-end">{{ __('End Date') }}</label>
                            <div class="col-md-6">
                                <input id="end_date" type="datetime-local"
                                    class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                                    value="{{ old('end_date', $event ? \Carbon\Carbon::parse($event->end_date)->format('Y-m-d\TH:i') : '') }}"
                                    required>
                                @error('end_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="location"
                                class="col-md-4 col-form-label text-md-end">{{ __('Location') }}</label>
                            <div class="col-md-6">
                                <input id="location" type="text"
                                    class="form-control @error('location') is-invalid @enderror" name="location"
                                    value="{{ old('location', $event->location ?? '') }}" required>
                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="latitude"
                                class="col-md-4 col-form-label text-md-end">{{ __('Latitude') }}</label>
                            <div class="col-md-6">
                                <input id="latitude" type="number" step="any"
                                    class="form-control @error('latitude') is-invalid @enderror" name="latitude"
                                    value="{{ old('latitude', $event->latitude ?? '') }}" required>
                                @error('latitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="longitude"
                                class="col-md-4 col-form-label text-md-end">{{ __('Longitude') }}</label>
                            <div class="col-md-6">
                                <input id="longitude" type="number" step="any"
                                    class="form-control @error('longitude') is-invalid @enderror" name="longitude"
                                    value="{{ old('longitude', $event->longitude ?? '') }}" required>
                                @error('longitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="max_attendees"
                                class="col-md-4 col-form-label text-md-end">{{ __('Max Attendees') }}</label>
                            <div class="col-md-6">
                                <input id="max_attendees" type="number"
                                    class="form-control @error('max_attendees') is-invalid @enderror"
                                    name="max_attendees" value="{{ old('max_attendees', $event->max_attendees ?? '') }}"
                                    required>
                                @error('max_attendees')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>
                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror"
                                    name="price" value="{{ old('price', $event->price ?? '') }}" required>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-6 text-center">
                                {{-- Image showing --}}
                                <img src="{{ $event && $event->image_url ? asset('images/events/' . $event->image_url) : asset('images/event-placeholder.png') }}"
                                    alt="{{ $event && $event->image_url ? 'Event Image' : 'Event Placeholder Image' }}"
                                    class="img-thumbnail mt-2 mb-2" style="width: 300px; height: 300px;">

                                {{-- Image input field --}}
                                <input id="image_file" name="image_file" type="file" accept=".png, .jpg"
                                    class="form-control @error('image_file') is-invalid @enderror">
                                @error('image_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ $event ? __('Update Event') : __('Create Event') }}
                                </button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary ml-2">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection