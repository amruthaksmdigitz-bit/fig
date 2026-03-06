<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'product_category_id',
         'barcode',
          'serial_number'
         
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
    public function images()
{
    return $this->hasMany(ProductImage::class);
}

public function variations()
{
    return $this->hasMany(\App\Models\Variation::class, 'product_id');
}

}
