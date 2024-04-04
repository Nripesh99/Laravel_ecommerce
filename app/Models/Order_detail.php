<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
  protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];


  public function orders(){
    return $this->belongsTo(Order::class,'order_id');
  }
  public function products(){
    return $this->belongsTo(Product::class,'product_id');
  }
  // public function users() {
  //   return $this->belongsTo(User::class, 'user_id');
  // }
}
