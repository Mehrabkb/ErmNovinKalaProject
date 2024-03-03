<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCompanyRole extends Model
{
    use HasFactory;
    protected $table = 'user_company_roles';
    protected $primaryKey = 'user_company_role_id';
    public $timestamps = false;
}
