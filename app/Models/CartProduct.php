<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;
    public $table = 'cart_product';
    protected $fillable = [
        'cart_id',
        'product_id',

    ];
}