<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table ='products';

    protected $fillable=[
        'name',
        'class',
        'price',
        'image',
        'status'
    ];
    public function variants()
    {
        return $this->hasMany('App\Models\Product_variant','product_id','id');

    }
}
