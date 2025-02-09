<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model implements Authenticatable
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

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->UserID; // or whatever field you use as your primary key
    }

    /**
     * Get the user name for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'UserID';
    }

    /**
     * Get the remember token for the user.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the remember token for the user.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the name of the "remember me" token column.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Get the name of the "password" column.
     *
     * @return string
     */
    public function getAuthPasswordName()
    {
        return 'password';
    }
}
