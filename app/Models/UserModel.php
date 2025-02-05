<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model 
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tbl_user_access';

    protected $primaryKey = 'UserID'; 

    protected $fillable = [
        'first_name', 
        'last_name',
        'user_name', 
        'user_email', 
        'contact_number',
        'password', 
        'user_role', 
        'user_status', 
        'modified_by', 
        'date_modified'
    ];
}
