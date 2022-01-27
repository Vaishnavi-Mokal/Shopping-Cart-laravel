<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_image extends Model
{
    use HasFactory;
    protected $fillable=['imagepath','product_id'];
    protected $table="product_images";
    
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
