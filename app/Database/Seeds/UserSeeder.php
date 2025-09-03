<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('auth_user')->truncate();

        $data = [
            ['first_name'=>'Rohit','last_name'=>'Kumar','email'=>'rohit1@example.com','password'=>password_hash('pass123', PASSWORD_BCRYPT)],
            ['first_name'=>'Anita','last_name'=>'Sharma','email'=>'anita2@example.com','password'=>password_hash('pass123', PASSWORD_BCRYPT)],
            ['first_name'=>'Vikas','last_name'=>'Verma','email'=>'vikas3@example.com','password'=>password_hash('pass123', PASSWORD_BCRYPT)],
            ['first_name'=>'Neha','last_name'=>'Singh','email'=>'neha4@example.com','password'=>password_hash('pass123', PASSWORD_BCRYPT)],
            ['first_name'=>'Arjun','last_name'=>'Mehta','email'=>'arjun5@example.com','password'=>password_hash('pass123', PASSWORD_BCRYPT)],
            ['first_name'=>'Pooja','last_name'=>'Yadav','email'=>'pooja6@example.com','password'=>password_hash('pass123', PASSWORD_BCRYPT)],
            ['first_name'=>'Amit','last_name'=>'Kapoor','email'=>'amit7@example.com','password'=>password_hash('pass123', PASSWORD_BCRYPT)],
            ['first_name'=>'Sneha','last_name'=>'Patel','email'=>'sneha8@example.com','password'=>password_hash('pass123', PASSWORD_BCRYPT)],
            ['first_name'=>'Rahul','last_name'=>'Mishra','email'=>'rahul9@example.com','password'=>password_hash('pass123', PASSWORD_BCRYPT)],
            ['first_name'=>'Sonali','last_name'=>'Jain','email'=>'sonali10@example.com','password'=>password_hash('pass123', PASSWORD_BCRYPT)],
            ['first_name'=>'Karan','last_name'=>'Chopra','email'=>'karan11@example.com','password'=>password_hash('pass123', PASSWORD_BCRYPT)],
            ['first_name'=>'Riya','last_name'=>'Gupta','email'=>'riya12@example.com','password'=>password_hash('pass123', PASSWORD_BCRYPT)],
            ['first_name'=>'Aakash','last_name'=>'Reddy','email'=>'aakash13@example.com','password'=>password_hash('pass123', PASSWORD_BCRYPT)],
            ['first_name'=>'Priya','last_name'=>'Saxena','email'=>'priya14@example.com','password'=>password_hash('pass123', PASSWORD_BCRYPT)],
            ['first_name'=>'Siddharth','last_name'=>'Malhotra','email'=>'siddharth15@example.com','password'=>password_hash('pass123', PASSWORD_BCRYPT)],
            ['first_name'=>'Meera','last_name'=>'Kohli','email'=>'meera16@example.com','password'=>password_hash('pass123', PASSWORD_BCRYPT)],
            ['first_name'=>'Aditya','last_name'=>'Bhatia','email'=>'aditya17@example.com','password'=>password_hash('pass123', PASSWORD_BCRYPT)],
            ['first_name'=>'Tanya','last_name'=>'Chawla','email'=>'tanya18@example.com','password'=>password_hash('pass123', PASSWORD_BCRYPT)],
            ['first_name'=>'Dev','last_name'=>'Nair','email'=>'dev19@example.com','password'=>password_hash('pass123', PASSWORD_BCRYPT)],
            ['first_name'=>'Isha','last_name'=>'Trivedi','email'=>'isha20@example.com','password'=>password_hash('pass123', PASSWORD_BCRYPT)],
        ];

        $this->db->table('auth_user')->insertBatch($data);
    }
}
