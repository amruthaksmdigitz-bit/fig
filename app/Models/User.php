<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'password',
        'profile_image',
        'location_id',
        'description',
        'cover_image',
        'role_id',
        'last_login_at' => 'datetime',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->slug = Str::slug($user->name);
        });

        static::updating(function ($user) {
            $user->slug = Str::slug($user->name);
        });
        // parent::boot();

        // static::creating(function ($user) {
        //     $slug = Str::slug($user->name);

        //     // Ensure unique slug
        //     $count = User::where('slug', 'LIKE', "{$slug}%")->count();

        //     $user->slug = $count ? "{$slug}-{$count}" : $slug;
        // });
    }
    // No need for multiple_images accessor anymore


    // Other methods unchanged


    // In app/Models/User.php
    public function multipleImages()
    {
        return $this->hasMany(UserMultipleImage::class, 'user_id', 'id');
    }
    public function locationRelation()
    {
        return $this->belongsTo(\App\Models\Location::class, 'location');
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function scopeActive($query, $days = 7)
    {
        return $query->where('last_login_at', '>=', now()->subDays($days));
    }

    /**
     * Scope for inactive users
     */
    public function scopeInactive($query, $days = 30)
    {
        return $query->where(function ($q) use ($days) {
            $q->where('last_login_at', '<', now()->subDays($days))
                ->orWhereNull('last_login_at');
        });
    }
    public function getLastLoginDisplayAttribute()
    {
        if (!$this->last_login_at) {
            return 'Never';
        }

        // Check for invalid MySQL zero date
        if (str_starts_with($this->last_login_at, '0000-00-00')) {
            return 'Never';
        }

        try {
            return \Carbon\Carbon::parse($this->last_login_at)->diffForHumans();
        } catch (\Exception $e) {
            return 'Never';
        }
    }
}
