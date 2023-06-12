<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RuleUser;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $userCount=RuleUser::where('role_id',2)->count();
        return view('admin.dashboard',compact('userCount'));
    }
}
