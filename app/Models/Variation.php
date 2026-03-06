<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    protected $fillable = [
        'serial_number',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
   
}
