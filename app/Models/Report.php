<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'reporter_id',
        'feed_id',
        'reported_user_id',
        'message',
        'screenshot',
        'status',           // Add this
        'admin_notes',      // Add this
        'reviewed_by',      // Add this
        'reviewed_at'       // Add this
    ];

    protected $casts = [
        'reviewed_at' => 'datetime'
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function feed()
    {
        return $this->belongsTo(Feed::class);
    }

    public function reportedUser()
    {
        return $this->belongsTo(User::class, 'reported_user_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    // Scopes for filtering
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeDismissed($query)
    {
        return $query->where('status', 'dismissed');
    }

    public function scopeResolved($query)
    {
        return $query->where('status', 'resolved');
    }

    // Accessor for screenshot URL
    public function getScreenshotUrlAttribute()
    {
        return $this->screenshot 
               ? asset('storage/' . $this->screenshot)
               : null;
    }
}