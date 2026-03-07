<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedImage extends Model
{
    protected $fillable = [
        'feed_id',
        'image'
    ];

    public function feed()
    {
        return $this->belongsTo(Feed::class);
    }
}