<?php

namespace App\Policies;

use App\Models\Jadwal;
use App\Models\Komunitas;

class JadwalPolicy
{
    // Hanya komunitas yang boleh membuat jadwal
    public function create($user): bool
    {
        return $user instanceof Komunitas;
    }

    // Hanya komunitas pemilik jadwal yang boleh edit/arsip/kembalikan/hapus
    public function update($user, Jadwal $jadwal): bool
    {
        return $user instanceof Komunitas
            && $user->id_komunitas === $jadwal->id_komunitas;
    }
}