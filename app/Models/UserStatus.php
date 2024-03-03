<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    use HasFactory;
    protected $table = 'user_statuses';
    protected $primaryKey = 'user_status_id';
    public $timestamps = false;
}
