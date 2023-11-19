<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PrivilegesModel;
use App\Models\UsersModel;

class Admin extends BaseController
{
    public function index()
    {
        $data = [];
        return view('/admin/index', $data);
    }

    public function users()
    {
        $usersModel = new UsersModel;
        $privilegesModel = new PrivilegesModel;

        $users = $usersModel->select(['user_id','username','email','created_at','updated_at'])->findall();
        $privilegesUsers = $privilegesModel->select(['privilege_id','user_id','admin'])->findAll();

        $usersArray = [];
        foreach ($users as $user => $fields) {
            $usersArray[$fields['user_id']] = [];
            foreach ($fields as $field => $value) {
                if($field != 'user_id'){
                    $usersArray[$fields['user_id']][$field] = $value;
                }
            }
        }

        $privilegesArray = [];
        foreach ($privilegesUsers as $user => $fields) {
            $privilegesArray[$fields['user_id']] = [];
            foreach ($fields as $field => $value) {
                if($field != 'user_id'){
                    $privilegesArray[$fields['user_id']][$field] = $value;
                }
            }
        }

        $data = [
            'users' => $usersArray,
            'privileges' => $privilegesArray
        ];
        return view('/admin/users/index', $data);
    }

    public function showUsers($username = null)
    {
        $usersModel = new UsersModel;
        $privilegesModel = new PrivilegesModel;
        $user = $usersModel->select(['user_id','username','email','created_at','updated_at'])->where('username', $username)->first();
        $editablePrivileges = $privilegesModel->select(['editable'])->where('user_id',$user['user_id'])->first()['editable'];

        $data = [
            'username'=>$username,
            'user'=>$user,
            'editablePrivileges'=>$editablePrivileges,
        ];
        return view('/admin/users/info', $data);
    }

    public function submitUsers($username = null)
    {
        $data = [];
        return view('/admin/users/info', $data);
    }

    public function showUserPrivileges($username = null)
    {
        $usersModel = new UsersModel;
        $privilegesModel = new PrivilegesModel;
        $userId = $usersModel->select(['user_id'])->where('username', $username)->first()['user_id'];
        $searchedPrivileges = $privilegesModel->select(['admin'])->where('user_id', $userId)->first();
        $privileges = $privilegesModel->select(['admin'])->where('user_id',session()->get('user_id'))->first();

        $data = [
            'username'=>$username,
            'user_id'=>$userId,
            'searchedPrivileges'=>$searchedPrivileges,
            'privileges'=>$privileges,
            'editable'=>$privilegesModel->select(['editable'])->where('user_id',$userId)->first()['editable'],
        ];
        return view('/admin/users/access', $data);
    }

    public function submitUserPrivileges($username = null)
    {
        $privilegesModel = new PrivilegesModel;
        $usersModel = new UsersModel;
        $userId = $usersModel->select(['user_id'])->where('username', $username)->first()['user_id'];
        $savedPrivileges = $privilegesModel->select(['admin'])->where('user_id', $userId)->first();
        $privilegeId = $privilegesModel->select(['privilege_id'])->where('user_id', $userId)->first()['privilege_id'];

        $data = [
            'admin' => is_null($this->request->getVar('admin')) ? "0" : "1",
        ];
        
        $updatedData = [];
        foreach ($data as $privilege => $value) {
            if($savedPrivileges[$privilege]!=$value){
                $updatedData[$privilege] = $value;
            }
        }
        if(count($updatedData)!=0){
            $privilegesModel->update($privilegeId, $updatedData);
        }

        $returnData = [
            'username'=>$username,
            'user_id'=>$userId,
            'searchedPrivileges'=>$privilegesModel->select(['admin'])->where('user_id', $userId)->first(),
            'privileges'=>$privilegesModel->select(['admin'])->where('privilege_id', session()->get('privilege_id'))->first(),
            'editable'=>$privilegesModel->select(['editable'])->where('user_id',$userId)->first()['editable'],
        ];
        return view('/admin/users/access', $returnData);
    }
}
