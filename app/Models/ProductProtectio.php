<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductProtection extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'protection_id',
        'vehicle_number',
    ];

    // Each product protection belongs to a protection plan
    public function protectionPlan()
    {
        return $this->belongsTo(ProtectionPlan::class, 'protection_id');
    }

    // If you have a Product model, link it
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
