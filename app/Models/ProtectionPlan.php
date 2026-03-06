<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProtectionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_date',
        'expiry_date',
    ];

    // One protection plan can belong to many product protections
    public function productProtections()
    {
        return $this->hasMany(ProductProtection::class, 'protection_id');
    }
}
