<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory, HasUuids;
    public $table = 'shipments';

    protected $fillable = [
        'order_id',
        'tracking_number',
        'status'
    ];
    protected $hidden = [];
    protected $casts = [];

    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class);
    }
}
