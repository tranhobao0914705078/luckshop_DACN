<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps = false;
    protected $fillable = ['brand_name', 'brand_product_image', 'brand_desc', 'brand_status'];
    protected $primaryKey = 'brand_id';
    protected $table = 'tbl_brand';

    public function product(){
        return $this->hasMany('App\Models\Product');
    }
}
