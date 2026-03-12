<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'is_hidden',        // Add this
        'report_count',     // Add this
        'hidden_at'         // Add this
    ];

    protected $casts = [
        'hidden_at' => 'datetime',
        'is_hidden' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(FeedImage::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    // Add this method to increment report count and auto-hide
    public function incrementReportCount()
    {
        $this->increment('report_count');
        
        // Auto-hide after 3 reports
        if ($this->report_count >= 3) {
            $this->update([
                'is_hidden' => true,
                'hidden_at' => now()
            ]);
        }
    }

    // Add method to hide post
    public function hide()
    {
        $this->update([
            'is_hidden' => true,
            'hidden_at' => now()
        ]);
    }

    // Add method to unhide post
    public function unhide()
    {
        $this->update([
            'is_hidden' => false,
            'hidden_at' => null
        ]);
    }

    // Scope to get only visible posts
    public function scopeVisible($query)
    {
        return $query->where('is_hidden', false);
    }
}