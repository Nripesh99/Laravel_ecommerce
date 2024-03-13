<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','user_id','category_id','image', 'SKU', 'product_description'];
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id',);
    }
    public function stock()
    {
        return $this->hasOne(Stock::class, 'product_id');
    }

}
