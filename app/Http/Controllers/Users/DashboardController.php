<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('Admin.Admin.dashboard');
    }

    public function cmsView()
    {
        return view('Admin.Admin.cms');
    }
    
}
