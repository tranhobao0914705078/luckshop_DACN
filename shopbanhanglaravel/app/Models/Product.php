<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'category_id', 'product_name', 'product_keywords', 'brand_id', 'product_desc', 
        'product_content', 'product_price', 'product_original_price', 'product_quantity', 'product_sold', 'product_image', 'product_tags', 'product_status'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';

    public function category(){
        return $this->belongsTo('App\Models\CategoryProductModel', 'category_id');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }
}
