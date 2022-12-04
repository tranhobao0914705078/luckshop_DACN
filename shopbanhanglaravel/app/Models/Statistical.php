<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistical extends Model
{
    public $timestamps = false;
    protected $fillable = ['order_date', 'sales', 'profit', 'quantity', 'total_order'];
    protected $primaryKey = 'id_statistical';
    protected $table = 'tbl_statistical';
}
