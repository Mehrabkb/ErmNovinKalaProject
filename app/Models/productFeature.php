<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productFeature extends Model
{
    use HasFactory;
    protected $table = 'product_features';
    protected $primaryKey = 'product_feature_id' ;
    public $timestamps = false;
}
