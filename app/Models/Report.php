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
        'screenshot'
    ];

    /**
     * Get the user who made the report
     */
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    /**
     * Get the reported feed
     */
    public function feed()
    {
        return $this->belongsTo(Feed::class);
    }

    /**
     * Get the reported user
     */
    public function reportedUser()
    {
        return $this->belongsTo(User::class, 'reported_user_id');
    }
}
