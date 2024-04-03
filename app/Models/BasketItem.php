<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketItem extends Model
{
    use HasFactory;
    protected $table = "basket_items";
    protected $primaryKey = "basket_item_id";
    public $timestamps = false;
}
