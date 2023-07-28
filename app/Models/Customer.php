<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory,HasUuids;

    public $table = 'customers';

    protected $fillable = [
        'name',
        'email',
        'address',
    ];
    protected $hidden = [];
    protected $casts = [];

   
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class,'user_id','id');
    }

    public function orders() 
    {
        return $this->hasMany(\App\Models\Order::class);
    }

}
