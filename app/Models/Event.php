<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'title',
        'description',
        'event_date',
        'location',
        'image',
    ];
    public function images()
    {
        return $this->hasMany(EventImage::class);
    }
}
