@foreach ($jadwal as $j)
    <div>
        {{ $j->judul }} — oleh {{ $j->komunitas->nama }}

        @if (Auth::guard('komunitas')->check() && Auth::guard('komunitas')->user()->can('update', $j))
            <a href="{{ route('jadwal.edit', $j) }}">Edit</a>
        @endif
    </div>
@endforeach