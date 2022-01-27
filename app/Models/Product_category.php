<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_category extends Model
{
    use HasFactory;
    protected $fillable=['product_id','product_category'];
    protected $table = "product_categories";
    
    public function category(){
        return $this->belongsTo(Category::class,'product_category','id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
