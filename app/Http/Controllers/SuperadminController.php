<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SuperadminController extends Controller
{
    public function SuperadminDashboard(){
        // return view('superadmin.superadmin_dashboard');
        return view('superadmin.index');
    }

    public function CreateUser():View{
        // return view('superadmin.superadmin_dashboard');
        return view('superadmin.user.create');
    }

}
