<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        $userModel = new \App\Models\UserModel();

        $error = null;

        if ($this->request->getMethod() === 'post') {
            $post = $this->request->getPost();
            $user = $userModel->where('email', $post['email'])->first();
            if ($user && $this->verifyPassword($post['password'], $user['password'])) {
                $session = session();
                $data = [
                    'user_id' => $user['id'],
                    'is_super_admin' => $user['is_super_admin'],
                    'logged_in' => true
                ];
                $session->set($data);
                return redirect()->to('/messages');
            }

            $error = 'Email or Password is incorrect.';
        }

        return view('auth/login', ['error' => $error]);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

    private function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
}