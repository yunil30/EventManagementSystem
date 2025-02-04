<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model {
    use HasFactory;

    // Disable automatic timestamp handling
    public $timestamps = false;

    // Define the table name (if it's different from the plural form of the model name)
    protected $table = 'tbl_user_info'; // The table in your database

    protected $primaryKey = 'UserID'; 

    // Define which fields are fillable (to protect against mass-assignment vulnerabilities)
    protected $fillable = [
        'first_name',
        'last_name',
        'user_name',
        'user_status',
    ];
}
