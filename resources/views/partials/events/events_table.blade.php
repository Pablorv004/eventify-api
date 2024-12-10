<div class="card">
    <div class="card-body">
        <h5 class="card-title text-uppercase mb-0">{{ $category_name }} events</h5>
    </div>
    <div class="table-responsive">
        <table class="table no-wrap user-table mb-0">
            <thead>
                @if($events->count())
                    <tr>
                        <th scope="col" class="border-0 text-uppercase font-medium pl-4">Event</th>
                        <th scope="col" class="border-0 text-uppercase font-medium">Description</th>
                        <th scope="col" class="border-0 text-uppercase font-medium">Organizer</th>
                        <th scope="col" class="border-0 text-uppercase font-medium">Category</th>
                        <th scope="col" class="border-0 text-uppercase font-medium">Start Date</th>
                        <th scope="col" class="border-0 text-uppercase font-medium">End Date</th>
                        <th scope="col" class="border-0 text-uppercase font-medium">Location</th>
                        <th scope="col" class="border-0 text-uppercase font-medium">Price</th>
                        <th scope="col" class="border-0 text-uppercase font-medium">Max Attendees</th>
                        <th scope="col" class="border-0 text-uppercase font-medium">Actions</th>
                    </tr>
                @endif
            </thead>
            @forelse($events as $event)
                <tbody>
                    <tr>
                        <td class="fw-bold align-content-center">
                            <h5>{{ $event->title }}</h5>
                        </td>
                        <td class="fw-bold align-content-center">
                            <h5>{{ $event->description }}</h5>
                        </td>
                        <td class="fw-bold align-content-center">
                            <h5>{{ $event->organizer->name }}</h5>
                        </td>
                        <td class="fw-bold align-content-center">
                            <h5>{{ $event->category->name }}</h5>
                        </td>
                        <td class="fw-bold align-content-center">
                            <h5>{{ $event->start_date }}</h5>
                        </td>
                        <td class="fw-bold align-content-center">
                            <h5>{{ $event->end_date }}</h5>
                        </td>
                        <td class="fw-bold align-content-center">
                            <h5>{{ $event->location }}</h5>
                        </td>
                        <td class="fw-bold align-content-center">
                            <h5>{{ $event->price }}</h5>
                        </td>
                        <td class="fw-bold align-content-center">
                            <h5>{{ $event->max_attendees }}</h5>
                        </td>
                        <td>
                            @if ($event->deleted == 1)
                                <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle" disabled>
                                    <i class="fa fa-trash" style="color: #a2a2a3"></i>
                                </button>
                            @else
                                <a href="{{ route('events.edit', $event) }}"
                                    class="btn btn-outline-info btn-circle btn-lg btn-circle">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button id="delete_event" class="btn btn-outline-info btn-circle btn-lg btn-circle"
                                    data-id="{{ $event->id }}" data-name="{{ $event->title }}"
                                    onclick="handleDeleteEvent(event)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                </tbody>
            @empty
                <tbody>
                    <tr class="align-content-center">
                        <td colspan="9" class="text-center">
                            <h3>There are no events to show</h3>
                        </td>
                    </tr>
                </tbody>
            @endforelse
        </table>
    </div>
    <div class="mt-3 me-3 ms-3">
        @if ($events->count())
            {{ $events->appends(['category' => strtolower($category_name)])->links() }}
        @endif
    </div>
</div>