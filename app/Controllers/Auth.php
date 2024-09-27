<?php
namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;
class Auth extends Controller{
    public function signup(){
        return view('auth/signup');
    }
    public function signupSubmit(){
        $userModel = new UserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT)
        ];
        $userModel->insert($data);
        return redirect()->to('/login');
    }
    public function login(){
        return view('auth/login');
    }
    public function loginSubmit(){
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $user = $userModel->where('username', $username)->first();
        if ($user && password_verify($password, $user['password'])) {
            session()->set(['user_id' => $user['id'], 'username' => $user['username']]);
            return redirect()->to('/todos');
        }
        else {
            return redirect()->to('/login')->with('error', 'Invalid login');
        }
    }

    public function logout(){
        session()->destroy();
        return redirect()->to('/login');
    }
}
