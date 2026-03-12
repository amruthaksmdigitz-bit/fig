<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMultipleImage extends Model
{
    protected $table = 'user_multipleimages';

    // Include 'thumbnail' here
    protected $fillable = ['user_id', 'image', 'thumbnail'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}