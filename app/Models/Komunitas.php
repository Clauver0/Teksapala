<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Komunitas extends Authenticatable
{
    use HasFactory;

    protected $table = 'komunitas';
    protected $primaryKey = 'id_komunitas';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_komunitas',
        'nama_komunitas',
        'display_name',
        'peran',
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

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->id_komunitas)) {
                $latest = static::max('id_komunitas');
                $number = $latest ? ((int) substr($latest, 1)) + 1 : 1;
                $model->id_komunitas = 'K' . str_pad($number, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}