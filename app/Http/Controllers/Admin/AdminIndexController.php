<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminIndexController extends Controller
{
    public function index(){
        return inertia('Admin/Index/Index',
        [
            'message' => 'Hello from Laravel!'
        ]
    );
    }
}
