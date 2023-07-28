<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\database\Eloquent\Concerns\HasUuids;

class Category extends Model
{
    use HasFactory, HasUuids;
    public $table = 'categories';

    public $fillable = [
        'id',
        'name',
        'is_hidden',
        'parent_id'
    ];
    
    protected $hidden = [];

    protected $casts = [
        'name'=>'string',
        'is_hidden' => 'boolean'
    ];

    //children are the subcategories that is categories that has no parent
    public function children() 
    {
        return $this->hasMany(\App\Models\Category::class,'parent_id');
    }


    public function parent()
    {
        return $this->belongsTo(\App\Models\Category::class,'id','parent_id');
    }

    public function products()
    {
        return $this->hasMany(\App\Models\Product::class);
    }
}
