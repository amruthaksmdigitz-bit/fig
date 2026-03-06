<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMultipleImage extends Model
{
    protected $table = 'user_multipleimages';

    protected $fillable = ['user_id', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
