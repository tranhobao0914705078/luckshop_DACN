<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProductModel extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'meta_keywords', 'category_name', 'category_desc', 'category_status', 'slug_category_product'
    ];
    protected $primaryKey = 'category_id';
    protected $table = 'tbl_category_product';

    public function product(){
        return $this->hasMany('App\Models\Product');
    }
}
