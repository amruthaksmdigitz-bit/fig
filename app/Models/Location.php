<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
	 
	 public function users()
    {
        return $this->hasMany(User::class, 'location_id');
    }
	 public static function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $count = 1;

        while (self::where('slug', $slug)->exists()) {
            $slug = Str::slug($name) . '-' . $count;
            $count++;
        }

        return $slug;
    }

}
