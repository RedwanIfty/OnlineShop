<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function activityLog(){
        $logs=ActivityLog::latest()->get();
        return view('admin.activityLog',compact('logs'));
    }
}
