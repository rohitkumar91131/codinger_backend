<?php
namespace App\Models;
use CodeIgniter\Model;

class TeacherModel extends Model {
    protected $table = 'teachers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'name', 'subject' , 'university_name' , 'gender' , 'year_joined'];
    protected $useTimestamps = true;
}
