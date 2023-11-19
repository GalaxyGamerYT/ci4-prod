<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PreferencesModel;
use App\Models\PrivilegesModel;
use App\Models\UsersModel;

class Register extends BaseController
{

    public function __construct(){
        helper(['form']);
    }

    public function index()
    {
        $data = [];
        return view('register', $data);
    }

    public function register()
    {
        $rules = [
            'username' => ['rules' => 'required|min_length[4]|max_length[255]|is_unique[users.username]'],
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[users.email]'],
            'password' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'confirm_password'  => [ 'label' => 'confirm password', 'rules' => 'matches[password]']
        ];


        if($this->validate($rules)){
            $usersModel = new UsersModel();
            $privilegesModel = new PrivilegesModel;
            $preferencesModel = new PreferencesModel;

            $user_data = [
                'username' => $this->request->getVar('username'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $usersModel->save($user_data);

            $user_id = $usersModel->where('email', $user_data['email'])->first()['user_id'];
            
            $privilegesModel->save(['user_id' => $user_id]);
            $preferencesModel->save(['user_id' => $user_id]);

            return redirect()->to('/login');
        }else{
            $data['validation'] = $this->validator;
            return view('register', $data);
        }

    }
}