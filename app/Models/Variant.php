<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    protected $fillable = ['name','product_id', 'image', 'price', 'stock'];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }
}