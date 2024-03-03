<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productBrand extends Model
{
    use HasFactory;
    protected $table = 'product_brands';
    protected $primaryKey = 'product_brand_id';
    public $timestamps = false;
}
