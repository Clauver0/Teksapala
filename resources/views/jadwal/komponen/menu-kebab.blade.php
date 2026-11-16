{{-- Menu kebab: Edit, Arsipkan, Hapus. Dipakai di dalam kartu-jadwal. --}}
@php($menuId = 'menu-kebab-' . $jadwal->id_jadwal)

<div class="kebab-menu" data-kebab>
    <button type="button"
            class="kebab-tombol"
            aria-label="Opsi untuk {{ $jadwal->judul }}"
            aria-haspopup="menu"
            aria-expanded="false"
            aria-controls="{{ $menuId }}"
            data-kebab-tombol>
        <img src="{{ asset('icons/kebab-menu.png') }}" alt="" width="20" height="20">
    </button>

    <ul class="kebab-daftar" id="{{ $menuId }}" role="menu" hidden>
        @if ($jadwal->is_archived)
            <li role="none">
                <form method="POST" action="{{ route('jadwal.kembalikan', $jadwal) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" role="menuitem" class="kebab-item">Kembalikan</button>
                </form>
            </li>
        @else
            <li role="none">
                <a role="menuitem" class="kebab-item" href="{{ route('jadwal.edit', $jadwal) }}">Edit</a>
            </li>

            <li role="none">
                <form method="POST" action="{{ route('jadwal.arsip', $jadwal) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" role="menuitem" class="kebab-item">Arsipkan</button>
                </form>
            </li>
        @endif

        <li role="none">
            <form method="POST"
                  action="{{ route('jadwal.destroy', $jadwal) }}"
                  data-konfirmasi="Hapus jadwal &quot;{{ $jadwal->judul }}&quot;?">
                @csrf
                @method('DELETE')
                <button type="submit" role="menuitem" class="kebab-item kebab-item--bahaya">Hapus</button>
            </form>
        </li>
    </ul>
</div>