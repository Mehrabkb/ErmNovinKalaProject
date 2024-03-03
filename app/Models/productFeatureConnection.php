<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productFeatureConnection extends Model
{
    use HasFactory;
    protected $table = 'product_feature_connections';
    protected $primaryKey = 'product_feature_connection_id';
    public $timestamps = false;
}
