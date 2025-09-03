<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'auth_user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['first_name', 'last_name', 'email', 'password', ];

    public function __construct($db = null)
    {
        parent::__construct($db); // Use DB passed from controller if provided
    }
}
