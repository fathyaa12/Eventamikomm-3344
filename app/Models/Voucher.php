<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'code',
        'discount_percentage',
        'discount_nominal',
        'valid_until',
        'quota',
        'event_id',
    ];

    protected $casts = [
        'valid_until' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
