<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Eloquent;


class Product extends Eloquent
{
    use HasFactory;
    protected $fillable=['name','description','price'];
        protected $table = 'products';

    function productcategory(){
        return $this->hasMany(Product_category::class,'product_id','id');
    }
    function image(){
        return $this->hasMany(Product_image::class,'product_id','id');
    }
    function attribute(){
        return $this->hasMany(Product_attribute_assoc::class,'product_id','id');
    }
    public function category(){
        return $this->belongsToMany(Category::class,'product_categories','product_category','product_id');
    }
    
        
}
