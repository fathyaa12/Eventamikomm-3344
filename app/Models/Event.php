<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    protected $fillable = [
        'category_id',
        'name',         // Ditambahkan agar sinkron dengan $event->name di Blade
        'slug',         // Ditambahkan untuk rute detail event berbasis slug
        'title',
        'description',
        'date',         // Kolom tanggal utama Anda
        'location',
        'price',
        'stock',
        'poster_path'   // Nama file poster yang disimpan di database
    ];

    /**
     * Cast properti tanggal agar otomatis menjadi objek Carbon
     */
    protected $casts = [
        'date' => 'datetime',
    ];

    /**
     * Hubungan Relasi ke Model Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Accessor untuk menyinkronkan $event->poster_asset_url di file Blade
     */
    public function getPosterAssetUrlAttribute()
    {
        // Mengecek apakah file ada di storage disk public
        if ($this->poster_path && Storage::disk('public')->exists($this->poster_path)) {
            return asset('storage/' . $this->poster_path);
        }

        // Gambar cadangan (fallback) jika data di database kosong atau file hilang
        return asset('assets/concert.png');
    }
}
