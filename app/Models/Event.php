<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    protected $fillable = [
        'category_id',
        'user_id',      // Relasi kepemilikan oleh organizer
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
        if ($this->poster_path) {
            if (str_starts_with($this->poster_path, 'http')) {
                return $this->poster_path;
            }
            return asset('storage/' . $this->poster_path);
        }

        // Gambar cadangan (fallback) jika data di database kosong atau file hilang
        return asset('assets/concert.png');
    }

    /**
     * Hubungan Relasi ke Model Review
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Accessor untuk mendapatkan rata-rata rating
     */
    public function getAverageRatingAttribute()
    {
        $avg = $this->reviews()->avg('rating');
        return $avg ? round($avg, 1) : 0;
    }

    public function tiers()
    {
        return $this->hasMany(TicketTier::class);
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }

    public function getActiveTierAttribute()
    {
        return $this->tiers()
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();
    }

    public function getCurrentPriceAttribute()
    {
        $activeTier = $this->active_tier;
        return $activeTier ? $activeTier->price : $this->price;
    }
}
