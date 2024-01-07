<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PreferencesModel;
use App\Models\PrivilegesModel;
use App\Models\UsersModel;

class Login extends BaseController
{

    public function __construct()
    {
        helper(['form']);
    }

    public function index()
    {
        return view('login');
    } 

    public function authenticate()
    {
        $session = session();
        $session->set('log','False');
        $rules = [
            'username' => ['rules' => 'required|min_length[4]|max_length[255]|is_unique[users.username]'],
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[users.email]'],
            'password' => ['rules' => 'required|min_length[8]|max_length[255]'],
        ];

        if($this->validate($rules)){
            $session->set('log','True');
            $usersModel = new UsersModel();
            $preferencesModel = new PreferencesModel;
            $privilegesModel = new PrivilegesModel;

            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');

            $user = $usersModel->where('email', $email)->first();
            $preferences = $preferencesModel->where('user_id', $user['user_id'])->first();
            $privileges = $privilegesModel->where('user_id', $user['user_id'])->first();

            if(is_null($user)) {
                return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
            }

            $pwd_verify = password_verify($password, $user['password']);

            if(!$pwd_verify) {
                return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
            }

            $ses_data = [
                'user_id' => $user['user_id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'isLoggedIn' => TRUE,
                'privilege_id' => $privileges['privilege_id'],
                'admin' => $privileges['admin'],
                'preference_id' => $preferences['preference_id'],
            ];

            $session->set($ses_data);
            return redirect()->to('/dashboard');
        }else{
            $data['validation'] = $this->validator;
            return view('login', $data);
        }

        
    }

    public function logout() {
        session_destroy();
        return redirect()->to('/login');
    }
}