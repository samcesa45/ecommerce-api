<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\database\eloquent\Concerns\HasUuids;

class Cart extends Model
{
    use HasFactory, HasUuids;
    
    public $table = 'carts';

    protected $fillable = [
        'cart_id',
        'status'
    ];

    protected $hidden = [];
    protected $casts = [
        'status' => 'string'
    ];

    public function cartItems() 
    {
        return $this->hasMany(\App\Models::CartItem::class,'cart_id');
    }
}
