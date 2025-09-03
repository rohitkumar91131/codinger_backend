<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use Firebase\JWT\JWT;

class Auth extends ResourceController {

    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect(); // Connect to PostgreSQL
    }

    // 🔹 New method to check DB connection
    public function checkConnection()
    {
        try {
            if ($this->db->connID) {
                return $this->respond(['success' => true, 'message' => 'Database connection is working!']);
            } else {
                return $this->respond(['success' => false, 'message' => 'Database connection failed!'], 500);
            }
        } catch (\Exception $e) {
            return $this->respond(['success' => false, 'error' => 'Connection error: ' . $e->getMessage()], 500);
        }
    }

    public function register()
    {
        $model = new UserModel($this->db);

        try {
            $input = $this->request->getJSON();

            if (!$input || !isset($input->email, $input->first_name, $input->last_name, $input->password)) {
                return $this->respond(['success' => false, 'error' => 'All fields are required'], 400);
            }

            if ($model->where('email', $input->email)->first()) {
                return $this->respond(['success' => false, 'error' => 'Email already exists'], 409);
            }

            $hashedPassword = password_hash($input->password, PASSWORD_BCRYPT);

            $saved = $model->save([
                'email' => $input->email,
                'first_name' => $input->first_name,
                'last_name' => $input->last_name,
                'password' => $hashedPassword
            ]);

            if (!$saved) {
                return $this->respond(['success' => false, 'error' => 'Failed to save user', 'dbErrors' => $model->errors()], 500);
            }

            return $this->respond(['success' => true, 'message' => 'User registered successfully'], 201);

        } catch (\Exception $e) {
            return $this->respond(['success' => false, 'error' => 'Database error: ' . $e->getMessage()], 500);
        }
    }

    public function login() {
        $model = new UserModel($this->db);

        try {
            $data = $this->request->getJSON();
            if (!$data || !isset($data->email, $data->password)) {
                return $this->respond(['success' => false, 'error' => 'Email and password are required'], 400);
            }

            $user = $model->where('email', $data->email)->first();
            if (!$user || !password_verify($data->password, $user['password'])) {
                return $this->respond(['success' => false, 'error' => 'Invalid credentials'], 401);
            }

            $key = getenv('JWT_SECRET') ?: 'secret_key';
            $payload = [
                'iss' => base_url(),
                'sub' => $user['id'],
                'iat' => time(),
                'exp' => time() + 3600
            ];

            $jwt = JWT::encode($payload, $key, 'HS256');

            return $this->respond(['success' => true, 'token' => $jwt]);

        } catch (\Exception $e) {
            return $this->respond(['success' => false, 'error' => 'Login error: ' . $e->getMessage()], 500);
        }
    }

    public function sendAllUser() {
        $model = new UserModel($this->db);

        try {
            $users = $model->findAll();
            foreach ($users as &$user) unset($user['password']);
            return $this->respond(['success' => true, 'users' => $users]);
        } catch (\Exception $e) {
            return $this->respond(['success' => false, 'error' => 'Failed to fetch users: ' . $e->getMessage()], 500);
        }
    }

    public function getUser($id)
    {
        $model = new UserModel($this->db);

        try {
            $user = $model->find($id);
            if (!$user) return $this->respond(['success' => false, 'error' => 'User not found'], 404);

            unset($user['password']);
            return $this->respond(['success' => true, 'user' => $user]);
        } catch (\Exception $e) {
            return $this->respond(['success' => false, 'error' => 'Failed to fetch user: ' . $e->getMessage()], 500);
        }
    }
}
