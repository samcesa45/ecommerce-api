<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\database\eloquent\Concerns\HasUuids;

class Brand extends Model
{
    use HasFactory, HasUuids;

    public $table = 'brands';

    protected $fillable = [
        'name'
    ];

    protected $hidden = [];

    protected $casts = [
        'name' => 'string'
    ];

    public function products()
    {
        return $this->hasMany(\App\Models\Product::class);
    }
}
