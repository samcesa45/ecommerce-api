<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\database\eloquent\Concerns\HasUuids;

class CartItem extends Model
{
    use HasFactory, HasUuids;

    public $table = 'cart_items';

    //qty_uom is quantity unit of measurement such as length, kilogram, etc
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'qty_uom',
        'final_unit_price',
        'unit_discount_pct',
        'status'
    ];

    protected $casts = [
     'cart_id' => 'string',
     'product_id' => 'string',
     'qty' => 'string',
     'qty_uom' => 'string',
     'final_unit_price' => 'decimal:2',
     'unit_discount_pct' => 'decimal:2',
     'status' => 'string'
    ];

    public function cart() 
    {
        return $this->belongsTo(\App\Models\Cart::class,'id','cart_id');
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class,'id','product_id');
    }
}
