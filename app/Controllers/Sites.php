<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SitesModel;

class Sites extends BaseController
{
    public function index()
    {
        $sitesModel = new SitesModel;
        $sites = $sitesModel->select(['site_id', 'site_name', 'site_link'])->findAll();
        $data = [
            'sites' => $sites
        ];
        return view('sites', $data);
    }
}
