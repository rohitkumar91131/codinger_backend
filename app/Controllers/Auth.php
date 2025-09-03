<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use Firebase\JWT\JWT;

class Auth extends ResourceController {

    public function register()
    {
        $model = new UserModel();
        try {
            $rawInput = file_get_contents('php://input');
            $input = json_decode($rawInput);

            if (!$input || !isset($input->email, $input->first_name, $input->last_name, $input->password)) {
                log_message('error', 'Register failed: Missing fields');
                return $this->respond(['success' => false, 'error' => 'All fields are required'], 400);
            }

            if ($model->where('email', $input->email)->first()) {
                log_message('error', 'Register failed: Email already exists - ' . $input->email);
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
                $errors = $model->errors();
                log_message('error', 'Register failed: Save error - ' . json_encode($errors));
                return $this->respond(['success' => false, 'error' => 'Failed to save user', 'dbErrors' => $errors], 500);
            }

            return $this->respond(['success' => true, 'message' => 'User registered successfully'], 201);

        } catch (\Exception $e) {
            log_message('error', 'Register exception: ' . $e->getMessage());
            return $this->respond(['success' => false, 'error' => 'Database error: ' . $e->getMessage()], 500);
        }
    }

    public function login() {
        $model = new UserModel();
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
            log_message('error', 'Login exception: ' . $e->getMessage());
            return $this->respond(['success' => false, 'error' => 'Login error: ' . $e->getMessage()], 500);
        }
    }

    public function sendAllUser() {
        $model = new UserModel();
        try {
            $users = $model->findAll();
            foreach ($users as &$user) {
                unset($user['password']); 
            }
            return $this->respond(['success' => true, 'users' => $users]);
        } catch (\Exception $e) {
            log_message('error', 'SendAllUser exception: ' . $e->getMessage());
            return $this->respond(['success' => false, 'error' => 'Failed to fetch users: ' . $e->getMessage()], 500);
        }
    }

    public function getUser($id)
    {
        $model = new UserModel();
        try {
            $user = $model->find($id);
            if (!$user) {
                return $this->respond(['success' => false, 'error' => 'User not found'], 404);
            }

            unset($user['password']); 
            return $this->respond(['success' => true, 'user' => $user]);
        } catch (\Exception $e) {
            log_message('error', 'getUser exception: ' . $e->getMessage());
            return $this->respond(['success' => false, 'error' => 'Failed to fetch user: ' . $e->getMessage()], 500);
        }
    }
}
