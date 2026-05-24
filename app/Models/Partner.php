<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Partner extends Model
{
    protected $fillable = ['name', 'logo_url'];

    
    public function getLogoAssetUrlAttribute()
    {
        return Storage::url($this->logo_url);
    }
}
