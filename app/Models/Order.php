<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  use HasFactory;
  protected $fillable = ['user_id', 'order_detail', 'total'];
  public function order_detail()
  {
    return $this->hasMany(Order_detail::class, 'order_id');

  }
  public function user(){
    return $this->belongsTo(User::class,'user_id');
  }
}