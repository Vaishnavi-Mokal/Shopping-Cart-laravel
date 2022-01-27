<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_attribute_assoc extends Model
{
    use HasFactory;
    protected $fillable=['product_id','color','size'];
    protected $table = "product_attribute_assocs";

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }

}
