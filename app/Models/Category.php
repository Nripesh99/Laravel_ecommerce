<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->hasMany(Category::class, 'category_id');
    }
    public function subcategory(){
        return $this->hasMany(Category::class,'parent_id','id');
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function ancestors()
    {
        return $this->parent ? $this->parent->ancestors()->merge([$this]) : collect([$this]);
    }

    
}
