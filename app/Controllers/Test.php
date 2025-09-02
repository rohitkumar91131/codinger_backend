<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;

class TestDB extends Controller
{
    public function index()
    {
        $userModel = new UserModel();
        try {
            $users = $userModel->findAll(); 
            return json_encode(['status' => 'success', 'data' => $users]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
