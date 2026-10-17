<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Donatur extends Authenticatable
{
    use HasFactory;

    protected $table = 'donatur';
    protected $primaryKey = 'id_donatur';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_donatur',
        'nama_lengkap',
        'display_name',
        'email',
        'username',
        'password',
        'no_telp',
        'profile_img',
        'header_img',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Dipakai di profil: $user->donations
    public function donations()
    {
        return $this->hasMany(Donasi::class, 'id_donatur', 'id_donatur');
    }

    protected static function booted()
    {
    static::creating(function ($model) {
        if (empty($model->id_donatur)) {
            $latest = static::max('id_donatur');
            $number = $latest ? ((int) substr($latest, 1)) + 1 : 1;
            $model->id_donatur = 'D' . str_pad($number, 5, '0', STR_PAD_LEFT);
        }
    });

    static::saving(function ($model) {
        if (!empty($model->nama_lengkap)) {
            $model->nama_lengkap = ucwords(strtolower($model->nama_lengkap));
        }
    });
    }
}