<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_variant extends Model
{
    use HasFactory;
    protected $table ='product_variants';

    protected $fillable=[
        'title',
        'availableStock',
        'product_id'
    ];

}
