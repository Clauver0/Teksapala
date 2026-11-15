<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JadwalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // ganti dengan policy bila perlu, mis. $this->user()->can(...)
    }

    public function rules(): array
    {
        $sedangTambah = $this->isMethod('post');

        return [
            'judul'               => ['required', 'string', 'max:150'],
            'lokasi_pelaksanaan'  => ['required', 'string', 'max:100'],
            'deskripsi'           => ['required', 'string', 'max:255'],
            'tanggal_pelaksanaan' => array_filter(['required', 'date', $sedangTambah ? 'after_or_equal:today' : null]),
            'gambar'              => [
                $sedangTambah ? 'required' : 'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048', // KB
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'judul'               => 'judul',
            'lokasi_pelaksanaan'  => 'lokasi pelaksanaan',
            'deskripsi'           => 'deskripsi',
            'tanggal_pelaksanaan' => 'tanggal pelaksanaan',
            'gambar'              => 'gambar sampul',
        ];
    }
}
