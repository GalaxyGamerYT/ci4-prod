<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PreferencesModel;

class Preferences extends BaseController
{
    public function __construct()
    {
        helper(['form']);
    }

    public function index()
    {
        $preferencesModel = new PreferencesModel;
        $preferences = $preferencesModel->select(['theme_mode'])->where('preference_id', session()->get('preference_id'))->first();
        $data = [
            'preferences'=>$preferences
        ];
        return view('preference', $data);
    }

    public function submit()
    {
        $preferencesModel = new PreferencesModel();
        $rules = [
            'theme_mode' => ['rules' => 'required']
        ];

        if($this->validate($rules)){
            $data = [
                'theme_mode' => $this->request->getVar('theme_mode'),
            ];

            $preferencesModel->update(session()->get('preference_id'), $data);
            return redirect()->to('/preferences');
        }else{
            $data['validation'] = $this->validator;
            return view('preference', $data);
        }
    }
}
