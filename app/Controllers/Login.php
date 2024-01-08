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
        $usersModel = new UsersModel();
        $preferencesModel = new PreferencesModel();
        $privilegesModel = new PrivilegesModel();

        $username_input = $this->request->getVar('username');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        if(is_null($username_input) or $username_input == ""){
            return redirect()->back()->withInput()->with('error', 'Please enter a username.');
        }

        if(is_null($email) or $email == ""){
            return redirect()->back()->withInput()->with('error', 'Please enter an email.');
        }

        if(is_null($password) or $password == ""){
            return redirect()->back()->withInput()->with('error', 'Please enter a password.');
        }

        $user = $usersModel->where('email', $email)->first();
        $preferences = $preferencesModel->where('user_id', $user['user_id'])->first();
        $privileges = $privilegesModel->where('user_id', $user['user_id'])->first();

        if(is_null($user)) {
            return redirect()->back()->withInput()->with('error', 'Invalid username.');
        }

        $pwd_verify = password_verify($password, $user['password']);

        if(!$pwd_verify) {
            return redirect()->back()->withInput()->with('error', 'Invalid password.');
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
    }

    public function logout() {
        session_destroy();
        return redirect()->to('/login');
    }
}