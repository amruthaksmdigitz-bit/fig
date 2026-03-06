<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'slug',
        'body',
        'image',
        'highlighted_image',
        'post_category_id',
        'user_id',
        'published',
    ];


    /**
     * Casts for specific columns.
     */
    protected $casts = [
        'published' => 'boolean',
    ];

     public function getIsAboutPageAttribute()
    {
        return $this->category_slug === 'abouts';
    }

    /**
     * Relationship: Post belongs to a category.
     */
    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    /**
     * Relationship: Post belongs to a user (author).
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
