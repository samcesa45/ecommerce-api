<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Product extends Model
{
    use HasFactory, HasUuids;
   public $table = 'products';

   protected $fillable= [
    'name',
    'description',
    'qty',
    'qty_uom',
    'final_unit_price',
    'unit_discount_pct',
    'image_url',
    'rating_score',
    'final_total_rating',
    'category_id',
    'brand_id',
    'status',
    'size',
    'color',
   ];
   protected $hidden = [];
   protected $casts = [
    'name' => 'string',
    'description'=> 'string',
    'qty'=> 'integer',
    'qty_uom' => 'string',
    'image_url' => 'string',
    'rating_score' => 'integer',
    'final_total_rating' => 'integer',
    'final_unit_price' => 'decimal:2',
    'unit_discount_pct'=> 'decimal:2',
    'status' => 'string',
    'size' => 'string',
    'color' => 'string'

   ];

   public function category()
   {
    return $this->belongsTo(\App\Models\Category::class);
   }

   public function orderItems()
   {
    return $this->hasMany(\App\Models\OrderItem::class);
   }

   public function brand()
   {
    return $this->belongsTo(\App\Models\Brand::class);
   }
}
