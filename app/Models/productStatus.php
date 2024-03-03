<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productStatus extends Model
{
    use HasFactory;
    protected $table = 'product_statuses';
    protected $primaryKey = 'product_status_id';
    public $timestamps = false;
}
