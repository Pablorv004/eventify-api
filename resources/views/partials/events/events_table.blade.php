<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<div class="card">
    <div class="card-body">
        <h5 class="card-title text-uppercase mb-0">{{ $category_name }} events</h5>
    </div>
    <div class="table-responsive">
        <table class="table no-wrap user-table mb-0" id="eventsTable">
            <thead>
                <tr>
                    <th class="border-0 text-uppercase font-medium pl-4">Event</th>
                    <th class="border-0 text-uppercase font-medium">Description</th>
                    <th class="border-0 text-uppercase font-medium">Organizer</th>
                    <th class="border-0 text-uppercase font-medium">Category</th>
                    <th class="border-0 text-uppercase font-medium">Start Date</th>
                    <th class="border-0 text-uppercase font-medium">End Date</th>
                    <th class="border-0 text-uppercase font-medium">Location</th>
                    <th class="border-0 text-uppercase font-medium">Price</th>
                    <th class="border-0 text-uppercase font-medium">Max Attendees</th>
                    <th class="border-0 text-uppercase font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
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
                @empty
                    <tr class="align-content-center">
                        <td colspan="10" class="text-center">
                            <h3>There are no events to show</h3>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    new DataTable('#eventsTable', {
        lengthMenu: [5, 10, 25, 50, 75, 100],
    });

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