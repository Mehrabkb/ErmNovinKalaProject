<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class publicTags extends Model
{
    use HasFactory;
    protected $table = 'public_tags';
    protected $primaryKey = 'public_tag_id';
    public $timestamps = false;
}
