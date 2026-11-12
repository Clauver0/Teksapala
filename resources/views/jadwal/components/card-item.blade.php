@props(['title', 'status', 'statusClass', 'date', 'image', 'endDate' => null])

<div class="card schedule-card mb-3">
    <img src="{{ $image }}" class="schedule-card-img" alt="{{ $title }}">
    <div class="schedule-card-body d-flex justify-content-between align-items-center">
        <div>
            <h6 class="fw-bold mb-1">{{ $title }}</h6>
        </div>
        <div class="text-end">
            <span class="status-badge {{ $statusClass }} me-3">: {{ $status }}</span>
            <span class="text-secondary small fw-bold d-inline-block text-end">
                {{ $date }}
                @if($endDate)
                    <br>{{ $endDate }}
                @endif
            </span>
        </div>
    </div>
</div>