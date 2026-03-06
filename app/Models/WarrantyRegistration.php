<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarrantyRegistration extends Model
{
    protected $fillable = [
	    'product_id',
        'serial_number',
        'dealer_name',
        'area',
        'body_parts',
        'email',
        'phone_number',
        'serial_number',
        'vehicle_number',
        'address',
        'expiry_date',
         'customer_name',
        'dealer_phone_number',
    ];
            public function product()
        {
            return $this->belongsTo(Product::class, 'product_id');
        }
        
        
        
        
        
}

?>
