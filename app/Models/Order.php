<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'billing_first_name', 'billing_last_name', 'billing_email',
        'billing_phone', 'billing_address', 'billing_city', 'billing_state',
        'billing_country', 'billing_zipcode', 'shipping_first_name',
        'shipping_last_name', 'shipping_email', 'shipping_phone',
        'shipping_address', 'shipping_city', 'shipping_state',
        'shipping_country', 'shipping_zipcode', 'payment_method', 'order_total'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('qty', 'selling_price');
    }
}
