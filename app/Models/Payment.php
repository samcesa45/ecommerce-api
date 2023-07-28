<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory,HasUuids;

    public $table = 'payments';
    protected $fillable = [
        'order_id',
        'payment_method',
        'amount'
    ];
    protected $hidden = [];
    protected $casts = [];


    public function order()
    {
      return $this->belongsTo(\App\Models\Order::class);
    }
}
