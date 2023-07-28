<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\database\Eloquent\Concerns\HasUuids;

class OrderItem extends Model
{
    use HasFactory,HasUuids;
    public $table = 'order_items';

    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'qty_uom',
        'final_unit_price',
        'unit_discount_pct',
        'status'
        
    ];
    protected $hidden = [];
    protected $casts = [];

    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class);
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }

}
