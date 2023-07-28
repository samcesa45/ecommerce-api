<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\database\eloquent\Concerns\HasUuids;

class ProductAttribute extends Model
{
    use HasFactory , HasUuids;

    public $table = 'product_attributes';

    protected $fillable = [
      'attribute',
      'value',
      'product_id'
    ];

    protected $casts = [
        'attribute' => 'string',
        'value' => 'string'
    ];

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class,'product_id');
    }
}
