<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inum extends Model
{
    use HasFactory;
    protected $table = 'inums';
    protected $primaryKey = 'inum_id';
    public $timestamps =false;
}
