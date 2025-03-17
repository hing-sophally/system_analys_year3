<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'user_id',
        'grand_total',
        'delivery_id',
        'pick_up_date_time',
        'status',
    ];

    // Relationship with the Customer
    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    // Relationship with the User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with the Delivery
    public function delivery()
    {
        return $this->belongsTo(Deliveries::class);
    }
}
