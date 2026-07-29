<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Partner extends Model
{
    protected $fillable = ['name', 'logo_url'];

    
    public function getLogoAssetUrlAttribute()
    {
        if (str_starts_with($this->logo_url, 'http')) {
            return $this->logo_url;
        }
        return Storage::disk('public')->url($this->logo_url);
    }
}
