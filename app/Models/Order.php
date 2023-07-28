<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory,hasUuids;
    public $table='orders';

    protected $fillable=[
        'user_id',
        'cart_id',
        'final_total_price',
        'total_discount_pct',
        'status'
    ];

    protected $hidden = [];
    protected $casts = [
        'final_total_price' => 'decimal:2',
        'total_discount_pct' => 'decimal:2',
        'status' => 'string'
    ];

    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class);
    }

    public function orderItems()
    {
        return $this->hasMany(\App\Models\OrderItem::class);
    }

    public function payment() 
    {
        return $this->hasOne(\App\Models\Payment::class);
    }

    public function shipment()
    {
       return $this->hasOne(\App\Models\Shipment::class);
    }
}
